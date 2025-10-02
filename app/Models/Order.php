<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'user_id',
        'totalamount',
        'orderdate',
        'status',
        
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Scopes
     */
    public function scopeStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
        return $query;
    }

    /**
     * Accessors
     */
    public function getFormattedTotalAttribute()
    {
        return 'Rs. ' . number_format($this->totalamount, 2);
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending'   => '🟡 Pending',
            'completed' => '🔵 Completed',
            'delivered' => '🟢 Delivered',
            'cancelled' => '🔴 Cancelled',
            default     => '⚪ Unknown',
        };
    }

    /**
     * Casts
     */
    protected $casts = [
        'orderdate' => 'datetime:d M Y',
        'totalamount' => 'decimal:2',
    ];

}

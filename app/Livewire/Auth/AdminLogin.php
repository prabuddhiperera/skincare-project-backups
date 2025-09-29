<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminLogin extends Component
{
    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::guard('admin')->attempt(
            ['email' => $this->email, 'password' => $this->password],
            $this->remember
        )) {
            return redirect()->route('admin.dashboard');
        }

        $this->addError('email', 'Invalid credentials.');
    }

    public function render()
    {
        return view('livewire.auth.admin-login');
    }
}


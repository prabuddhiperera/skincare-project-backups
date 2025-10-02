<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;

class FavouriteController extends Controller
{
    public function index()
    {
        $favourites = Favourite::where('user_id', auth()->id())->with('product')->get();
        return view('favourites', compact('favourites'));
    }

    public function destroy($id)
    {
        $fav = Favourite::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $fav->delete();
        return redirect()->route('user.favourites')->with('success', 'Product removed from favourites.');
    }
}

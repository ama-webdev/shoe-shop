<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function home()
    {
        return view('user.home');
    }
    public function shop()
    {
        $products = Product::with('sizes', 'colors')->paginate(10);
        return view('user.shop', compact('products'));
    }
}
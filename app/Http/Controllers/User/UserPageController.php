<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Brand;
use App\Models\Gender;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserPageController extends Controller
{
    public function home()
    {
        return view('user.home');
    }
    public function shop(Request $request)
    {
        $category = $request->category;
        $brand = $request->brand;
        $gender = $request->gender;
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::with('sizes', 'colors')
            ->when($category, function ($query, $category) {
                $category_record = Category::where('name', $category)->first();
                if ($category_record) {
                    $category_id = $category_record->id;
                } else {
                    $category_id = 0;
                }
                $query->where('category_id', $category_id);
            })
            ->when($brand, function ($query, $brand) {
                $brand_record = Brand::where('name', $brand)->first();
                if ($brand_record) {
                    $brand_id = $brand_record->id;
                } else {
                    $brand_id = 0;
                }
                $query->where('brand_id', $brand_id);
            })->when($gender, function ($query, $gender) {
                $gender_record = Gender::where('name', $gender)->first();
                if ($gender_record) {
                    $gender_id = $gender_record->id;
                } else {
                    $gender_id = 0;
                }
                $query->where('gender_id', $gender_id);
            })->paginate(12)
            ->appends(request()->query());
        return view('user.shop', compact('products', 'categories', 'brands'));
    }

    public function cart()
    {
        return view('user.cart');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->intended('dashboard');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
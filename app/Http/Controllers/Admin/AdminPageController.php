<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class AdminPageController extends Controller
{
    public function dashboard()
    {
        $user_count = User::count();
        $category_count = Category::count();
        $brand_count = Brand::count();
        $order_count = Order::count();
        $product_count = Product::count();

        return view('admin.dashboard', compact('user_count', 'category_count', 'brand_count', 'order_count', 'product_count'));
    }
    public function orderSummary()
    {
        $orders = [];
        $j = 1;
        for ($i = 0; $i < 11; $i++) {
            $orders[$i] = Order::whereMonth('created_at', $j)->count();
            $j++;
        }
        $data = json_encode($orders);
        return response()->json(['data' => $data], 200);
    }
}
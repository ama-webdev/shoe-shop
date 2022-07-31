<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Helpers\UUID;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class UserOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('order_details.product')->where('user_id', Auth::user()->id)->paginate(10);
        return view('user.orders', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::with('order_details.product.sizes', 'order_details.product.colors')->where('unique_code', $id)->first();
        if (!$order) {
            abort(404);
        }
        return view('user.order_details', compact('order'));
    }
    public function store(Request $request)
    {
        $order_items = json_decode($request->data);
        DB::beginTransaction();
        try {

            // save order
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->unique_code = UUID::generate();
            $order->order_code = UUID::OrderCode();
            $order->status = 'confirm';
            $order->save();

            // save order detial
            foreach ($order_items as $order_item) {
                $order_detail = new OrderDetail();
                $order_detail->order_id = $order->id;
                $order_detail->product_id = $order_item->id;
                $order_detail->qty = $order_item->qty;
                $order_detail->color_id = $order_item->color_id;
                $order_detail->size_id = $order_item->size_id;
                $order_detail->save();
            }

            DB::commit();
            return response()->json(['data' => "Successfully ordered."], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage], 422);
        }
        foreach ($order_items as $order_item) {
        }
    }
}
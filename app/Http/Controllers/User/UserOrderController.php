<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Helpers\UUID;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
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

    public function ssd(Request $request)
    {
        $status = $request->status;
        $order_code = $request->order_code;
        $query = Order::with('order_details')->query();

        return Datatables::of($query)
            ->filter(function () use ($order_code, $status, $query) {
                if ($order_code) {
                    $query = $query->where('order_code', $order_code);
                }
                if ($status) {
                    $query = $query->where('status', $status);
                }
            })
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d');
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->updated_at)->format('Y-m-d');
            })
            ->rawColumns([''])
            ->make(true);
    }
}
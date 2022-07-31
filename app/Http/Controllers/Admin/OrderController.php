<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Helpers\UUID;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;


class OrderController extends Controller
{

    public function index()
    {
        return view('admin.orders.index');
    }
    public function show($id)
    {
        $order = Order::with('order_details.product.sizes', 'order_details.product.colors')->where('unique_code', $id)->first();
        if (!$order) {
            abort(404);
        }
        return view('admin.orders.order_details', compact('order'));
    }

    public function edit()
    {
    }
    public function ssd(Request $request)
    {
        $status = $request->status;
        $order_code = $request->order_code;
        $query = Order::with('order_details');

        return Datatables::of($query)
            ->filter(function () use ($order_code, $status, $query) {
                if ($order_code) {
                    $query = $query->where('order_code', $order_code);
                }
                if ($status) {
                    $query = $query->where('status', $status);
                }
            })
            ->addColumn('qty', function ($each) {
                return count($each->order_details);
            })
            ->addColumn('total', function ($each) {
                $total = 0;
                foreach ($each->order_details as $detail) {
                    $total += $detail->product->price;
                }
                return $total;
            })
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d');
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->updated_at)->format('Y-m-d');
            })
            ->editColumn('order_code', function ($each) {
                return '<a href="' . route('admin.orders.show', $each->unique_code) . '">' . $each->order_code . '</a>';
            })
            // ->addColumn('action', function ($each) {
            //     $edit = '<a href="' . route('admin.orders.edit', $each->unique_code) . '" class="edit-btn me-2"><i class="fa-solid fa-pen-to-square" style="font-size:1.2rem;color:#444;"></i></a>';
            //     $view = '<a href="' . route('admin.orders.show', $each->unique_code) . '" class="view-btn me-2"><i class="fas fa-eye" style="font-size:1.2rem;color:#444;></i></a>';
            //     return $view . ' ' . $edit;
            // })
            ->rawColumns(['action', 'order_code'])
            ->make(true);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Helpers\UUID;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create-brand'])->only(['create', 'store']);
        $this->middleware(['permission:update-brand'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-brand'])->only(['destroy']);
    }
    public function index()
    {
        return view('admin.brands.index');
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|min:3|unique:brands,name',
        ]);

        $name = $request->name;
        $brand = new brand();
        $brand->name = $name;
        $brand->unique_code = UUID::generate();
        $brand->brand_code = UUID::brandCode();
        $brand->save();

        return redirect()->route('admin.brands.index')->with('created', 'Successfully Created.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $brand = Brand::where('unique_code', $id)->first();
        if (!$brand) {
            abort(404);
        }
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::where('unique_code', $id)->first();
        if (!$brand) {
            abort(404);
        }
        $brand_id = $brand->id;
        $validate = $request->validate([
            'name' => 'required|string|min:3|unique:brands,name,' . $brand_id,
        ]);

        $name = $request->name;
        $brand->name = $name;
        $brand->update();

        return redirect()->route('admin.brands.index')->with('updated', 'Successfully Updated.');
    }

    public function destroy($id)
    {
        $brand = Brand::where('unique_code', $id)->first();
        if (!$brand) {
            abort(404);
        }
        $brand->delete();
        return "success";
    }

    public function ssd(Request $request)
    {
        $name = $request->name;
        $brand_code = $request->brand_code;
        $query = brand::query();

        return Datatables::of($query)
            ->filter(function () use ($name, $brand_code, $query) {
                if ($name) {
                    $query = $query->where('name', $name);
                }
                if ($brand_code) {
                    $query = $query->where('brand_code', $brand_code);
                }
            })
            ->addColumn('action', function ($each) {
                $edit = '<a href="' . route('admin.brands.edit', $each->unique_code) . '" class="edit-btn me-2"><i class="fa-solid fa-pen-to-square" style="font-size:1.2rem;color:#444;"></i></a>';
                $delete = '<a href="#" class="text-danger delete-btn" data-id="' . $each->unique_code . '"><i class="fas fa-trash"></i></a>';
                return $edit . $delete;
            })
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d');
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->updated_at)->format('Y-m-d');
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
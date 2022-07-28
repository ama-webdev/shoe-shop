<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Helpers\UUID;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create-category'])->only(['create', 'store']);
        $this->middleware(['permission:update-category'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-category'])->only(['destroy']);
    }
    public function index()
    {
        return view('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|min:3|unique:categories,name',
        ]);

        $name = $request->name;
        $category = new Category();
        $category->name = $name;
        $category->unique_code = UUID::generate();
        $category->category_code = UUID::CategoryCode();
        $category->save();

        return redirect()->route('admin.categories.index')->with('created', 'Successfully Created.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::where('unique_code', $id)->first();
        if (!$category) {
            abort(404);
        }
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('unique_code', $id)->first();
        if (!$category) {
            abort(404);
        }
        $category_id = $category->id;
        $validate = $request->validate([
            'name' => 'required|string|min:3|unique:categories,name,' . $category_id,
        ]);

        $name = $request->name;
        $category->name = $name;
        $category->update();

        return redirect()->route('admin.categories.index')->with('updated', 'Successfully Updated.');
    }

    public function destroy($id)
    {
        $category = Category::where('unique_code', $id)->first();
        if (!$category) {
            abort(404);
        }
        $category->delete();
        return "success";
    }

    public function ssd(Request $request)
    {
        $name = $request->name;
        $category_code = $request->category_code;
        $query = Category::query();

        return Datatables::of($query)
            ->filter(function () use ($name, $category_code, $query) {
                if ($name) {
                    $query = $query->where('name', $name);
                }
                if ($category_code) {
                    $query = $query->where('category_code', $category_code);
                }
            })
            ->addColumn('action', function ($each) {
                $edit = '<a href="' . route('admin.categories.edit', $each->unique_code) . '" class="edit-btn me-2"><i class="fa-solid fa-pen-to-square" style="font-size:1.2rem;color:#444;"></i></a>';
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
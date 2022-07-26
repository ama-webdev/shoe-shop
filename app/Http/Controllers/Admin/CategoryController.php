<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create-category|edit-category|delete-category|update-category'])->only(['create', 'update', 'edit', 'destroy']);
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
        $category->save();

        return redirect()->route('admin.categories.index')->with('created', 'Successfully Created.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|min:3|unique:categories,name,' . $id,
        ]);

        $name = $request->name;

        $category = Category::findOrFail($id);
        $category->name = $name;
        $category->update();

        return redirect()->route('admin.categories.index')->with('updated', 'Successfully Updated.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return "success";
    }

    public function ssd(Request $request)
    {
        $name = $request->name;
        $query = Category::query();

        return Datatables::of($query)
            ->filter(function () use ($name, $query) {
                if ($name) {
                    $query = $query->where('name', $name);
                }
            })
            ->addColumn('action', function ($each) {
                $edit = '<a href="' . route('admin.categories.edit', $each->id) . '" class="edit-btn me-2"><i class="fa-solid fa-pen-to-square" style="font-size:1.2rem;color:#444;"></i></a>';
                $delete = '<a href="#" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="fas fa-trash"></i></a>';
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
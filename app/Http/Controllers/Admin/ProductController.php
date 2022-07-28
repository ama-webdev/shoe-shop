<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Size;
use App\Helpers\UUID;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Gender;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create-product'])->only(['create', 'store']);
        $this->middleware(['permission:update-product'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-product'])->only(['destroy']);
    }
    public function index()
    {
        $categories = Category::all();
        $genders = Gender::all();
        $brands = Brand::all();
        return view('admin.products.index', compact('categories', 'genders', 'brands'));
    }

    public function create()
    {
        $categories = Category::all();
        $genders = Gender::all();
        $sizes = Size::all();
        $colors = Color::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'genders', 'sizes', 'colors', 'brands'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|min:3',
            'price' => 'required|required|regex:/^\d+(\.\d{1,2})?$/|numeric|gt:0',
            'detail' => 'required|string',
            'category' => 'required|exists:categories,id',
            'gender' => 'required|exists:genders,id',
            'brand' => 'required|exists:brands,id',
            'image' => 'required|mimes:jpg,jgeg,png|max:10000',
            'sizes' => 'required',
            'colors' => 'required'
        ]);

        $product_code = UUID::ProductCode();
        $unique_code = UUID::generate();

        $name = $request->name;
        $price = $request->price;
        $detail = $request->detail;
        $category = $request->category;
        $brand = $request->brand;
        $gender = $request->gender;
        $sizes = $request->sizes;
        $colors = $request->colors;
        $image = $request->image;

        // store image in products folder
        $image_name = date('Ymd') . $product_code .  '.' . $image->extension();
        $image_url = "/images/products/$image_name";
        $image->move(public_path('images/products'), $image_name);

        // insert product record
        $product = new Product();
        $product->name = $name;
        $product->price = $price;
        $product->product_code = $product_code;
        $product->unique_code = $unique_code;
        $product->detail = $detail;
        $product->gender_id = $gender;
        $product->brand_id = $brand;
        $product->category_id = $category;
        $product->image = $image_url;
        $product->save();

        // insert colors and sizes to pivots
        foreach ($colors as $color) {
            $product->colors()->attach($color);
        }
        foreach ($sizes as $size) {
            $product->sizes()->attach($size);
        }

        return redirect()->route('admin.products.index')->with('created', 'Successfully created.');
    }

    public function show($id)
    {
        $product = Product::with('colors', 'sizes', 'category', 'gender')->where('unique_code', $id)->first();
        if (!$product) {
            abort(404);
        }
        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $genders = Gender::all();
        $sizes = Size::all();
        $colors = Color::all();
        $brands = Brand::all();
        $product = Product::where('unique_code', $id)->first();

        $product_sizes = [];
        $product_colors = [];

        foreach ($product->sizes as $size) {
            $product_sizes[] = $size->id;
        }
        foreach ($product->colors as $color) {
            $product_colors[] = $color->id;
        }

        if (!$product) {
            abort(404);
        }
        return view('admin.products.edit', compact('categories', 'genders', 'sizes', 'colors', 'brands', 'product', 'product_sizes', 'product_colors'));
    }

    public function update(Request $request, $id)
    {
        // return $request->all();
        $product = Product::where('unique_code', $id)->first();
        if (!$product) {
            abort(404);
        }
        $old_image = $product->image;
        $product_sizes = [];
        $product_colors = [];

        foreach ($product->sizes as $size) {
            $product_sizes[] = $size->id;
        }
        foreach ($product->colors as $color) {
            $product_colors[] = $color->id;
        }

        $validate = $request->validate([
            'name' => 'required|string|min:3',
            'price' => 'required|required|regex:/^\d+(\.\d{1,2})?$/|numeric|gt:0',
            'detail' => 'required|string',
            'category' => 'required|exists:categories,id',
            'gender' => 'required|exists:genders,id',
            'brand' => 'required|exists:brands,id',
            'image' => 'mimes:jpg,jgeg,png|max:10000',
            'sizes' => 'required',
            'colors' => 'required'
        ]);

        $name = $request->name;
        $price = $request->price;
        $detail = $request->detail;
        $category = $request->category;
        $brand = $request->brand;
        $gender = $request->gender;
        $sizes = $request->sizes;
        $colors = $request->colors;
        $image = $request->image;

        if ($image) {
            // store image in products folder if has new image
            $image_name = date('Ymdhis') . $product->product_code .  '.' . $image->extension();
            $image_url = "/images/products/$image_name";
            $image->move(public_path('images/products'), $image_name);

            // delete old image if has new image
            $old_image_url = substr($old_image, 1);
            if (File::exists($old_image_url)) {
                File::delete($old_image_url);
            }
        } else {
            $image_url = $old_image;
        }

        // insert product record

        $product->name = $name;
        $product->price = $price;
        $product->detail = $detail;
        $product->gender_id = $gender;
        $product->brand_id = $brand;
        $product->category_id = $category;
        $product->image = $image_url;
        $product->update();

        // insert colors and sizes to pivots
        $product->colors()->detach($product_colors);
        foreach ($colors as $color) {
            $product->colors()->attach($color);
        }
        $product->sizes()->detach($product_sizes);
        foreach ($sizes as $size) {
            $product->sizes()->attach($size);
        }

        return redirect()->route('admin.products.index')->with('updated', 'Successfully updated.');
    }

    public function destroy($id)
    {
        $product = Product::where('unique_code', $id)->first();
        if (!$product) {
            abort(404);
        }
        $image_url = substr($product->image, 1);
        if (File::exists($image_url)) {
            File::delete($image_url);
        }
        $product->delete();
        return 'success';
    }

    public function ssd(Request $request)
    {
        $name = $request->name;
        $product_code = $request->product_code;
        $brand_id = $request->brand_id;
        $gender_id = $request->gender_id;
        $category_id = $request->category_id;

        $query = Product::with('sizes', 'colors', 'brand', 'category');

        return Datatables::of($query)
            ->filter(function () use ($name, $product_code, $brand_id, $gender_id, $category_id, $query) {
                if ($name) {
                    $query = $query->where('name', $name);
                }
                if ($product_code) {
                    $query = $query->where('product_code', $product_code);
                }
                if ($category_id) {
                    $query = $query->where('category_id', $category_id);
                }
                if ($brand_id) {
                    $query = $query->where('brand_id', $brand_id);
                }
                if ($gender_id) {
                    $query = $query->where('gender_id', $gender_id);
                }
            })
            ->addColumn('action', function ($each) {
                $edit = '<a href="' . route('admin.products.edit', $each->unique_code) . '" class="edit-btn me-2"><i class="fa-solid fa-pen-to-square" style="font-size:1.2rem;color:#444;"></i></a>';
                $delete = '<a href="#" class="text-danger delete-btn" data-id="' . $each->unique_code . '"><i class="fas fa-trash"></i></a>';
                return $edit . $delete;
            })
            ->editColumn('name', function ($each) {
                $name =
                    '<a href="' . route('admin.products.show', $each->unique_code) . '" style="text-decoration:none; color:#333;text-transform:capitalize;">' . $each->name . '</a>';
                return $name;
            })
            ->editColumn('image', function ($each) {
                $url = asset($each->image);
                $image = '<img src="' . $url . '" />';
                return $image;
            })
            ->editColumn('price', function ($each) {
                return number_format($each->price, 2);
            })
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d');
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->updated_at)->format('Y-m-d');
            })
            ->addColumn('sizes', function ($each) {
                $sizes = $each->sizes;
                $buttons = '';
                foreach ($sizes as $size) {
                    $button = '<button class="size">' . $size->name . '</button>';
                    $buttons .=  $button;
                }
                return '<div class="sizes">' . $buttons . '</div>';
            })
            ->addColumn('brand', function ($each) {
                return $each->brand->name;
            })
            ->addColumn('category', function ($each) {
                return $each->category->name;
            })
            ->addColumn('gender', function ($each) {
                return $each->gender->name;
            })
            ->addColumn('colors', function ($each) {
                $colors = $each->colors;
                $buttons = '';
                foreach ($colors as $color) {
                    $button = '<div class="color" style="background-color:' . $color->name . '"></div>';
                    $buttons .=  $button;
                }
                return '<div class="colors">' . $buttons . '</div>';
            })
            ->rawColumns(['action', 'image', 'name', 'colors', 'sizes'])
            ->make(true);
    }
}
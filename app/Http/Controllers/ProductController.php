<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        $title = "Products";
        $products = Product::with('category')->paginate(10);
        return view('admins.products.index', compact('title', 'products'));
    }


    public function create()
    {
        $title = "Add Product";
        $categories = Category::whereNull('category_parent_id')->with('children')->get();
        $options = $this->getCategoryOptions($categories);
        return view('admins.products.create', compact('title', 'options'));
    }

    private function getCategoryOptions($categories, $level = 0)
    {
        $options = [];
        foreach ($categories as $category) {
            $prefix = str_repeat('&nbsp;&nbsp;', $level * 4) . ($level > 0 ? '-- ' : '');
            $options[$category->id] = $prefix . $category->category_name;
            if ($category->children->isNotEmpty()) {
                $options += $this->getCategoryOptions($category->children, $level + 1);
            }
        }
        return $options;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_product' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|max:5000',
            'price' => 'required|numeric|min:0',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'has_variants' => 'boolean',
            'is_active' => 'boolean',
        ], [
            'name_product.required' => 'Vui lòng nhập tên sản phẩm',
            'name_product.string' => 'Tên sản phẩm phải là chuỗi',
            'name_product.max' => 'Tên sản phẩm không quá 100 kí tự',
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm',
            'category_id.exists' => 'Danh mục không tồn tại',
            'description.required' => 'Vui lòng nhập mô tả sản phẩm',
            'description.max' => 'Mô tả không quá 5000 kí tự',
            'price.required' => 'Vui lòng nhập giá',
            'price.numeric' => 'Giá phải là một số',
            'price.min' => 'Giá phải lớn hơn 0',

            'avatar.required' => 'Tải lên ảnh sản phẩm',
            'avatar.image' => 'Đây không phải ảnh',
            'avatar.mimes' => 'Phần mở rộng ảnh không hợp lệ',
            'avatar.max' => 'Kích thước ảnh không quá 2mb',
            'has_variants.boolean' => 'Loại sản phẩm không hợp lệ',
            'is_active.boolean' => 'Trạng thái không hợp lệ',
        ]);


        if ($validator->fails()) {
            return back()->with('error', "Vui lòng nhập đúng, đầy đủ thông tin sản phẩm");
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $pathImage = $request->file('avatar')->store('products', 'public');
            $fullNameImage = 'storage/' . $pathImage;

            $data = $request->all();
            $data['avatar'] = $fullNameImage;

            Product::create($data);

            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo thành công');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra khi tải lên ảnh sản phẩm');
    }


    public function edit(string $id)
    {
        $title = "Update Product";
        $product = Product::find($id);
        $categories = Category::whereNull('category_parent_id')->with('children')->get();
        $options = $this->getCategoryOptions($categories);
        return view('admins.products.edit', compact('title', 'options', 'product'));
    }


    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $validator = Validator::make($request->all(), [
            'name_product' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|max:5000',
            'price' => 'required|numeric|min:0',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'has_variants' => 'boolean',
            'is_active' => 'boolean',
        ], [
            'name_product.required' => 'Vui lòng nhập tên sản phẩm',
            'name_product.string' => 'Tên sản phẩm phải là chuỗi',
            'name_product.max' => 'Tên sản phẩm không quá 100 kí tự',
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm',
            'category_id.exists' => 'Danh mục không tồn tại',
            'description.required' => 'Vui lòng nhập mô tả sản phẩm',
            'description.max' => 'Mô tả không quá 5000 kí tự',
            'price.required' => 'Vui lòng nhập giá',
            'price.numeric' => 'Giá phải là một số',
            'price.min' => 'Giá phải lớn hơn 0',

            'avatar.image' => 'Đây không phải ảnh',
            'avatar.mimes' => 'Phần mở rộng ảnh không hợp lệ',
            'avatar.max' => 'Kích thước ảnh không quá 2mb',
            'has_variants.boolean' => 'Loại sản phẩm không hợp lệ',
            'is_active.boolean' => 'Trạng thái không hợp lệ',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator);
        }

        $data = $request->except('avatar');

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $pathImage = $request->file('avatar')->store('products', 'public');
            $fullNameImage = 'storage/' . $pathImage;
            $data['avatar'] = $fullNameImage;

            if ($product->avatar && file_exists($product->avatar)) {
                unlink($product->avatar);
            }
        } else {
            $data['avatar'] = $product->avatar;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Update product successfully!');
    }


    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (file_exists($product->avatar)) {
            unlink($product->avatar);
        }
        if ($product->delete()) {
            return back()->with('success', "Delete product successfully!");
        } else {
            return back()->with('error', "Delete product failed!");
        }
    }
}

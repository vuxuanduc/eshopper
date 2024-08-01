<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PermissionRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        $permissionCategory = PermissionRole::getPermission('Category', Auth::user()->role_id);
        $permissionAddCategory = PermissionRole::getPermission('Add Category', Auth::user()->role_id);
        $permissionEditCategory = PermissionRole::getPermission('Edit Category', Auth::user()->role_id);
        $permissionDeleteCategory = PermissionRole::getPermission('Delete Category', Auth::user()->role_id);
        if (empty($permissionCategory)) {
            abort(404);
        }
        $title = "Categories";
        $categories = Category::with('parent')->paginate(10);
        return view('admins.categories.index', compact('title', 'categories', 'permissionCategory', 'permissionAddCategory', 'permissionEditCategory', 'permissionDeleteCategory'));
    }


    public function create()
    {
        $permissionAddCategory = PermissionRole::getPermission('Add Category', Auth::user()->role_id);
        if (empty($permissionAddCategory)) {
            abort(404);
        }
        $title = "Add Category";
        $categories = Category::whereNull('category_parent_id')->with('children')->get();
        $options = $this->getCategoryOptions($categories);
        return view('admins.categories.create', compact('options', 'title'));
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
        $permissionAddCategory = PermissionRole::getPermission('Add Category', Auth::user()->role_id);
        if (empty($permissionAddCategory)) {
            abort(404);
        }
        $data = $request->all();
        $newCategory = Category::query()->create($data);
        if ($newCategory) {
            return redirect()->route('categories.index')->with('success', "Create category successfully!");
        }
    }


    public function edit(string $id)
    {
        $permissionEditCategory = PermissionRole::getPermission('Edit Category', Auth::user()->role_id);
        if (empty($permissionEditCategory)) {
            abort(404);
        }
        $title = "Update Category";
        $category = Category::find($id);
        $categories = Category::whereNull('category_parent_id')->with('children')->get();
        $options = $this->getCategoryOptions($categories);
        return view('admins.categories.edit', compact('options', 'title', 'category'));
    }


    public function update(Request $request, string $id)
    {
        $permissionEditCategory = PermissionRole::getPermission('Edit Category', Auth::user()->role_id);
        if (empty($permissionEditCategory)) {
            abort(404);
        }
        $category = Category::find($id);
        $data = $request->all();
        if ($category->update($data)) {
            return redirect()->route('categories.index')->with('success', "Update category successfully!");
        } else {
            return redirect()->route('categories.index')->with('error', "Update category failed!");
        }
    }


    public function destroy(string $id)
    {
        $permissionDeleteCategory = PermissionRole::getPermission('Delete Category', Auth::user()->role_id);
        if (empty($permissionDeleteCategory)) {
            abort(404);
        }
        $category = Category::find($id);
        if ($category->delete()) {
            return back()->with('success', "Delete category successfully!");
        } else {
            return back()->with('error', "Delete category failed!");
        }
    }
}

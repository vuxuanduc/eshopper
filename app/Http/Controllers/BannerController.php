<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\PermissionRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{

    public function index()
    {
        $permissionBanner = PermissionRole::getPermission('Banner', Auth::user()->role_id);
        $permissionAddBanner = PermissionRole::getPermission('Add Banner', Auth::user()->role_id);
        $permissionEditBanner = PermissionRole::getPermission('Edit Banner', Auth::user()->role_id);
        $permissionDeleteBanner = PermissionRole::getPermission('Delete Banner', Auth::user()->role_id);
        if (empty($permissionBanner)) {
            abort(404);
        }
        $title = "Banner";
        $banners = Banner::query()->paginate(10);
        return view('admins.banners.index', compact('title', 'banners', 'permissionBanner', 'permissionAddBanner', 'permissionEditBanner', 'permissionDeleteBanner'));
    }


    public function create()
    {
        $permissionAddBanner = PermissionRole::getPermission('Add Banner', Auth::user()->role_id);
        if (empty($permissionAddBanner)) {
            abort(404);
        }
        $title = "Add Banner";
        return view('admins.banners.create', compact('title'));
    }


    public function store(Request $request)
    {
        $permissionAddBanner = PermissionRole::getPermission('Add Banner', Auth::user()->role_id);
        if (empty($permissionAddBanner)) {
            abort(404);
        }
        $validator = Validator::make($request->all(), [
            'banner_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
        ], [

            'banner_url.required' => 'Tải lên ảnh sản phẩm',
            'banner_url.image' => 'Đây không phải ảnh',
            'banner_url.mimes' => 'Phần mở rộng ảnh không hợp lệ',
            'banner_url.max' => 'Kích thước ảnh không quá 2mb',
            'is_active.boolean' => 'Trạng thái không hợp lệ',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', "Recheck the data!");
        }

        if ($request->hasFile('banner_url') && $request->file('banner_url')->isValid()) {
            $pathImage = Storage::putFile('banners', $request->file('banner_url'));

            $fullNameImage = 'storage/' . $pathImage;

            $data = $request->all();
            $data['banner_url'] = $fullNameImage;

            Banner::query()->create($data);

            return redirect()->route('banners.index')->with('success', 'Sản phẩm đã được tạo thành công');
        }

        return redirect()->back()->with('error', 'Create banner failed!');
    }


    public function edit(string $id)
    {
        $permissionEditBanner = PermissionRole::getPermission('Edit Banner', Auth::user()->role_id);
        if (empty($permissionEditBanner)) {
            abort(404);
        }
        $title = "Update banner";
        $banner = Banner::find($id);
        return view('admins.banners.edit', compact('title', 'banner'));
    }


    public function update(Request $request, string $id)
    {
        $permissionEditBanner = PermissionRole::getPermission('Edit Banner', Auth::user()->role_id);
        if (empty($permissionEditBanner)) {
            abort(404);
        }
        $banner = Banner::find($id);

        $data = $request->except('banner_url');

        if ($request->hasFile('banner_url') && $request->file('banner_url')->isValid()) {

            $validator = Validator::make($request->all(), [
                'banner_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'is_active' => 'boolean',
            ], [
                'banner_url.image' => 'Đây không phải ảnh',
                'banner_url.mimes' => 'Phần mở rộng ảnh không hợp lệ',
                'banner_url.max' => 'Kích thước ảnh không quá 2mb',
                'is_active.boolean' => 'Trạng thái không hợp lệ',
            ]);

            if ($validator->fails()) {
                return back()->with('error', $validator);
            }

            $pathImage = $request->file('banner_url')->store('banners', 'public');
            $fullNameImage = 'storage/' . $pathImage;


            $data['banner_url'] = $fullNameImage;

            if ($banner->banner_url && file_exists($banner->banner_url)) {
                unlink($banner->banner_url);
            }
        } else {
            $data['banner_url'] = $banner->banner_url;
        }

        $banner->update($data);

        return redirect()->route('banners.index')->with('success', "Update banner successfully!");
    }


    public function destroy(string $id)
    {
        $permissionDeleteBanner = PermissionRole::getPermission('Delete Banner', Auth::user()->role_id);
        if (empty($permissionDeleteBanner)) {
            abort(404);
        }
        $banner = Banner::find($id);
        $nameImage = $banner->banner_url;
        if ($banner->delete()) {
            if (file_exists($nameImage)) {
                unlink($nameImage);
            }
            return back()->with('success', "Delete banner successfully!");
        } else {
            return back()->with('error', "Delete banner failed!");
        }
    }
}

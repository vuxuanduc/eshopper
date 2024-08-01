<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function homePage()
    {
        $saleProducts = Product::select('id', 'name_product', 'avatar', 'price', 'new_price')->where('category_id', '=', '2')->get();
        $newProducts = Product::select('id', 'name_product', 'avatar', 'price', 'new_price')->where('category_id', '=', '1')->get();
        $categories = Category::select('id', 'category_name')->where('is_active', '=', '0')->get();
        $banners = Banner::select('id', 'banner_url')->where('is_active', '=', '1')->get();
        return view('clients.home', compact('saleProducts', 'categories', 'newProducts', 'banners'));
    }

    public function shopPage(Request $request)
    {
        $categories = Category::select('id', 'category_name')->where('is_active', '=', '0')->get();
        $listProducts = Product::select('id', 'name_product', 'price', 'new_price', 'avatar')->where('category_id', '=', $request->category_id)->get();
        return view('clients.shop', compact('categories', 'listProducts'));
    }

    public function detailPage(Request $request)
    {
        $product = Product::find($request->product_id);
        $listProducts = Product::select('id', 'name_product', 'price', 'new_price', 'avatar')->where('category_id', '=', $product->category_id)->get();
        $categories = Category::select('id', 'category_name')->where('is_active', '=', '0')->get();
        return view('clients.detail', compact('categories', 'product', 'listProducts'));
    }

    public function cartPage()
    {
        $cart = Session::get('cart', []);
        $categories = Category::select('id', 'category_name')->where('is_active', '=', '0')->get();
        return view('clients.cart', compact('categories', 'cart'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity,
                'name' => $request->input('name_product'),
                'price' => $request->input('price'),
                'image' => $request->input('image'),
            ];
        }

        Session::put('cart', $cart);

        $totalQuantity = array_sum(array_column($cart, 'quantity'));
        Session::put('numberCart', $totalQuantity);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);

            $totalQuantity = array_sum(array_column($cart, 'quantity'));
            Session::put('numberCart', $totalQuantity);
        }

        return back();
    }

    public function checkOutPage(Request $request)
    {
        $productId = $request->product_id;
        $nameProduct = $request->name_product;
        $price = $request->price;
        $quantity = $request->quantity;
        $totalAmount = $price * $quantity;
        $categories = Category::select('id', 'category_name')->where('is_active', '=', '0')->get();
        return view('clients.check_out', compact('categories', 'nameProduct', 'price', 'quantity', 'totalAmount', 'productId'));
    }
}

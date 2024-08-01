<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orders()
    {
        $title = "Orders";
        $orders = DB::table('orders')->select('orders.id', 'orders.total_price', 'orders.order_date', 'users.name', 'order_statuses.status_order')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('order_statuses', 'order_statuses.id', '=', 'orders.status_order_id')
            ->paginate(10);
        return view('admins.orders.index', compact('title', 'orders'));
    }

    public function editOrder(Request $request)
    {
        $title = "Edit Order";
        $order = DB::table('orders')->select('orders.id', 'orders.status_order_id', 'orders.total_price', 'orders.order_date', 'users.name', 'order_statuses.status_order')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('order_statuses', 'order_statuses.id', '=', 'orders.status_order_id')
            ->where('orders.id', '=', $request->order_id)
            ->first();
        $statuses = OrderStatus::select('id', 'status_order')->get();
        return view('admins.orders.edit', compact('title', 'order', 'statuses'));
    }

    public function updateOrder(Request $request)
    {

        $order = Order::find($request->order_id);

        $order->update([
            'status_order_id' => $request->status_order_id,
        ]);

        return redirect('/panel/orders')->with('success', "Update order successfully!");
    }

    public function detailOrder(Request $request)
    {
        $title = "Detail Order";
        $orderDetail = DB::table('orders')->select('orders.total_price', 'orders.order_date', 'orders.phone', 'orders.address', 'orders.receiver', 'orders.code_bill', 'order_items.quantity', 'order_items.price_at_purchase', 'order_statuses.status_order', 'products.name_product')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('order_statuses', 'orders.status_order_id', '=', 'order_statuses.id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('orders.id', '=', $request->order_id)
            ->first();
        return view('admins.orders.detail', compact('title', 'orderDetail'));
    }
}

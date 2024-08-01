<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function generateInvoice(Request $request)
    {
        $orderDetail = DB::table('orders')->select('orders.total_price', 'orders.order_date', 'orders.phone', 'orders.address', 'orders.receiver', 'orders.code_bill', 'order_items.quantity', 'order_items.price_at_purchase', 'order_statuses.status_order', 'products.name_product')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('order_statuses', 'orders.status_order_id', '=', 'order_statuses.id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('orders.id', '=', $request->order_id)
            ->first();

        $data = [
            'orderDetail' => $orderDetail
        ];

        $pdf = PDF::loadView('admins.invoices.invoice', $data);

        return $pdf->stream('invoice.pdf');
    }
}

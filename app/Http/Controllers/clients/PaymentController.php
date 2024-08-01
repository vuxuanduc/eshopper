<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Mail\BillOrder;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function vnPay(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('payment.callback');
        $vnp_TmnCode = "7JGVXU97";
        $vnp_HashSecret = "BEK5YE52QW00BWCOIIE915VTYYLNAIP1";

        $vnp_TxnRef = rand(100000000, 999999999);
        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = "Thanh toán online";
        $vnp_Amount = 100000 * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate"=> $vnp_ExpireDate ,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            $dataOrder = [
                'user_id' => Auth::user()->id,
                'status_order_id' => 1,
                'total_price' => $vnp_Amount,
                'order_date' => Carbon::now(),
                'receiver' => $request->receiver,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'code_bill' => $vnp_TxnRef
            ];

            $newOrder = Order::query()->create($dataOrder);

            Session::put('order_id', $newOrder->id);

            $dataOrderItem = [
                'order_id' => $newOrder->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price_at_purchase' => $request->price_at_purchase
            ];

            OrderItem::query()->create($dataOrderItem);

            return redirect($vnp_Url);
        } else {
            echo json_encode($returnData);
        }
    }

    public function callBack(Request $request)
    {
        if ($request->vnp_TransactionStatus && $request->vnp_TransactionStatus == "00") {
            $order = Order::find(Session::get('order_id'));
            $orderUpdate = $order->update([
                'status_order_id' => 2
            ]);

            if ($orderUpdate) {
                $orderDetail = DB::table('orders')->select('orders.total_price', 'orders.order_date', 'orders.phone', 'orders.address', 'orders.receiver', 'orders.code_bill', 'order_items.quantity', 'order_items.price_at_purchase', 'products.name_product')
                    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                    ->join('products', 'products.id', '=', 'order_items.product_id')
                    ->where('orders.id', '=', $order->id)
                    ->first();
                Mail::to(Auth::user()->email)->send(new BillOrder($orderDetail));
            }
            Session::forget('order_id');
            return redirect('/');
        }
    }
}

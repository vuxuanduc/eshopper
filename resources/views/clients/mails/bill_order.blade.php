<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bill Order</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 700px;
            background-color: #ffffff;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .detail {
            display: flex;
            width: 100%;
            justify-content: space-between;
            margin-top: 16px;
        }

        .detail span {
            font-size: 16px;
        }

        .detail .fw-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Hóa đơn thanh toán</h2>
        </div>
        <div class="detail">
            <p>Cảm ơn bạn đã mua hàng tại hệ thống của chúng tôi. Sau đây là hóa đơn của bạn!</p>
        </div>
        <div class="detail">
            <span class="fw-bold">Người đặt:</span>
            <span>{{ Auth::user()->name }}</span>
        </div>
        <div class="detail">
            <span class="fw-bold">Tên sản phẩm:</span>
            <span>{{ $orderDetail->name_product }}</span>
        </div>
        <div class="detail">
            <span class="fw-bold">Số lượng:</span>
            <span>{{ $orderDetail->quantity }}</span>
        </div>
        <div class="detail">
            <span class="fw-bold">Giá:</span>
            <span>{{ $orderDetail->price_at_purchase }}</span>
        </div>
        <div class="detail">
            <span class="fw-bold">Tổng tiền:</span>
            <span>{{ $orderDetail->total_price }}</span>
        </div>
        <div class="detail">
            <span class="fw-bold">Ngày đặt:</span>
            <span>{{ $orderDetail->order_date }}</span>
        </div>
        <div class="detail">
            <span class="fw-bold">Người nhận:</span>
            <span>{{ $orderDetail->receiver }}</span>
        </div>
        <div class="detail">
            <span class="fw-bold">Số điện thoại:</span>
            <span>{{ $orderDetail->phone }}</span>
        </div>
        <div class="detail">
            <span class="fw-bold">Địa chỉ:</span>
            <span>{{ $orderDetail->address }}</span>
        </div>
        <div class="detail">
            <span class="fw-bold">Trạng thái:</span>
            <span>Đã thanh toán</span>
        </div>
        <div class="detail">
            <span class="fw-bold">Mã thanh toán:</span>
            <span>{{ $orderDetail->code_bill }}</span>
        </div>
    </div>
</body>

</html>

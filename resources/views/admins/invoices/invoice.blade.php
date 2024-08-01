<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        /* Reset CSS for consistency */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        /* Container styling */
        .container {
            padding: 20px;
        }

        /* Flexbox container */
        .d-flex {
            display: flex;
        }

        /* Justify content between items */
        .justify-content-between {
            justify-content: space-between;
        }

        /* Margin top */
        .mt-4 {
            margin-top: 1.5rem; /* 24px */
        }

        /* Padding bottom */
        .pb-4 {
            padding-bottom: 1.5rem; /* 24px */
        }

        /* Padding x-axis */
        .px-3 {
            padding-left: 1rem; /* 16px */
            padding-right: 1rem; /* 16px */
        }

        /* Order title styling */
        .order-title {
            font-weight: bold;
            color: #333;
        }

        /* Styling for each row */
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem; /* 16px */
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Invoice</h2>
        <div class="row mt-4">
            <span class="order-title">Name product: </span>
            <span>{{ $orderDetail->name_product }}</span>
        </div>
        <div class="row mt-4">
            <span class="order-title">Price: </span>
            <span>{{ $orderDetail->price_at_purchase }}</span>
        </div>
        <div class="row mt-4">
            <span class="order-title">Quantity: </span>
            <span>{{ $orderDetail->quantity }}</span>
        </div>
        <div class="row mt-4">
            <span class="order-title">Total price: </span>
            <span>{{ $orderDetail->total_price }}</span>
        </div>
        <div class="row mt-4">
            <span class="order-title">Order date: </span>
            <span>{{ $orderDetail->order_date }}</span>
        </div>
        <div class="row mt-4">
            <span class="order-title">Status order: </span>
            <span>{{ $orderDetail->status_order }}</span>
        </div>
        <div class="row mt-4">
            <span class="order-title">Code bill: </span>
            <span>{{ $orderDetail->code_bill }}</span>
        </div>
        <div class="row mt-4">
            <span class="order-title">Receiver: </span>
            <span>{{ $orderDetail->receiver }}</span>
        </div>
        <div class="row mt-4">
            <span class="order-title">Phone: </span>
            <span>{{ $orderDetail->phone }}</span>
        </div>
        <div class="row mt-4">
            <span class="order-title">Address: </span>
            <span>{{ $orderDetail->address }}</span>
        </div>
    </div>
</body>
</html>

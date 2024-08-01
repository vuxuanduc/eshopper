@extends('admins.master_layout')

@section('css')
    <style>
      form{
        font-size: 14px;
      }
      #name, #email{
        font-size: 14px;
      }
      #roleId {
          font-size:14px;
      }
      .col-10 {
        font-size: 14px;
      }
      .order-title {
        font-weight: 600;
      }
    </style>
@endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ $title }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('panel/dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    @include('auth._message')

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <div>
                <div class="col-10 pb-4">
                    <div class="d-flex justify-content-between">
                        <span class="order-title">Name product</span>
                        <span>{{ $orderDetail->name_product }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="order-title">Price</span>
                        <span>{{ $orderDetail->price_at_purchase }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="order-title">Quantity</span>
                        <span>{{ $orderDetail->quantity }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="order-title">Total price</span>
                        <span>{{ $orderDetail->total_price }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="order-title">Order date</span>
                        <span>{{ $orderDetail->order_date }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="order-title">Status order</span>
                        <span>{{ $orderDetail->status_order }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="order-title">Code bill</span>
                        <span>{{ $orderDetail->code_bill }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="order-title">Receiver</span>
                        <span>{{ $orderDetail->receiver }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="order-title">Phone</span>
                        <span>{{ $orderDetail->phone }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="order-title">Address</span>
                        <span>{{ $orderDetail->address }}</span>
                    </div>
                </div>
              </div>
            </div>
          </div>
    </section>
  </main>
@endsection


@section('script')
    
@endsection
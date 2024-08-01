@extends('admins.master_layout')

@section('css')
    <style>
      thead th {
        font-size: 14px;
      }
      tbody {
        font-size: 14px;
      }
      .name-product {
        width: 130px;
      }
      .description div{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100px;
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
      <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Orderer</th>
                <th>Total Price</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
              <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->total_price }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->status_order }}</td>
                <td>
                  <span class="d-flex">
                    <a href="{{ url('/panel/edit-order/' .$order->id) }}" class="text-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="{{ url('/panel/detail-order/' .$order->id) }}"><i class="fa-regular mx-2 fa-eye"></i></a>
                    <a href="{{ url('/panel/generateInvoice/' .$order->id) }}"><i class="fa-solid fa-print"></i></a>
                  </span>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </section>
    <div class="d-flex justify-content-between">
      <div>
       
      </div>
      <div>
        {{ $orders->links() }}
      </div>
    </div>
  </main>
@endsection
@section('script')
    
@endsection
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
              <form method="post" action="{{ url('/panel/update-order/' .$order->id) }}">
                @csrf
                @method("PATCH")
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="name" class="col-sm-2 col-form-label fw-bold">Orderer</label>
                    <input type="text" value="{{ $order->name }}" class="form-control" id="name"  readonly>
                  </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                      <label for="name" class="col-sm-2 col-form-label fw-bold">Total price</label>
                      <input type="text" value="{{ $order->total_price }}" class="form-control" id="name"  readonly>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-10">
                      <label for="name" class="col-sm-2 col-form-label fw-bold">Order date</label>
                      <input type="text" value="{{ $order->order_date }}" class="form-control" id="name"  readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                      <label for="name" class="col-sm-2 col-form-label fw-bold">Order status</label>
                      <select name="status_order_id" id="roleId" class="form-select">
                        @foreach ($statuses as $status)
                            <option {{ $order->status_order_id == $status->id ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->status_order }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>

                <div>
                  <button type="submit" class="btn btn-primary" style="font-size: 14px">Submit</button>
              </form>

            </div>
          </div>
    </section>
  </main>
@endsection


@section('script')
    
@endsection
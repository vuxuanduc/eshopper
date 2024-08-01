@extends('clients.master_layout')
@section('css')
    
@endsection

@section('slider')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shopping Cart</p>
        </div>
    </div>
</div>
<!-- Page Header End -->
@endsection

@section('content')



<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-12 table-responsive mb-5">
            @if(!empty($cart))
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Image</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach($cart as $id => $details)
                            <tr>
                                <td>
                                    <img src="{{ asset($details['image']) }}" alt="Product Image" style="width: 50px;">
                                </td>
                                <td class="align-middle">{{ $details['name'] }}</td>
                                <td class="align-middle">${{ number_format($details['price'], 2) }}</td>
                                <td class="align-middle">{{ $details['quantity'] }}</td>
                                
                                {{-- <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" data-id="{{ $id }}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary text-center" value="{{ $details['quantity'] }}" readonly>
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus" data-id="{{ $id }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td> --}}
                                <td class="align-middle">${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                <td class="align-middle">
                                    <form action="{{ url('/cartRemove', $id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h5 class="text-center">Giỏ hàng của bạn đang trống!</h5>
            @endif
        </div>
        
    </div>
</div>
@endsection
@section('scripts')
        
@endsection

@extends('clients.master_layout')

@section('css')
    
@endsection

@section('slider')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Checkout</p>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid pt-5">
    <form class="row px-xl-5" id="checkoutForm" onsubmit="return checkForm()" method="POST" action="{{ route('payment.create') }}">
        @csrf
        <div class="col-lg-8">
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">Địa chỉ giao hàng</h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Họ và tên</label> <span class="text-danger mx-2 name_err"></span>
                        <input class="form-control" type="text" name="receiver" id="name" placeholder="Họ và tên">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label> <span class="text-danger mx-2 email_err"></span>
                        <input class="form-control" type="email" name="email" id="email" placeholder="example@email.com">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Số điện thoại</label> <span class="text-danger mx-2 phone_err"></span>
                        <input class="form-control" type="text" name="phone" id="phone" placeholder="+123 456 789">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Địa chỉ</label> <span class="text-danger mx-2 address_err"></span>
                        <input class="form-control" type="text" name="address" id="address" placeholder="123 Hà Nội">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-medium mb-3">Sản phẩm</h5>
                    <div class="d-flex justify-content-between">
                        <p>{{ $nameProduct }}</p>
                        <p>${{ $price }}</p>
                    </div>
                    
                    <hr class="mt-0">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Số lượng</h6>
                        <h6 class="font-weight-medium">{{ $quantity }}</h6>
                    </div>
                    
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Tổng tiền</h5>
                        <h5 class="font-weight-bold">${{ $totalAmount }}</h5>
                    </div>
                </div>
            </div>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Payment</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" checked name="payment" id="paypal">
                            <label class="custom-control-label" for="paypal">Vnpay</label>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{ $productId }}" name="product_id">
                {{-- <input type="hidden" value="1000000" name="product_id"> --}}
                <input type="hidden" value="{{ $quantity }}" name="quantity">
                <input type="hidden" value="{{ $price }}" name="price_at_purchase">
                <input type="hidden" value="{{ $totalAmount }}" name="total_amount">
                <div class="card-footer border-secondary bg-transparent">
                    <button name="redirect" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Thanh toán</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    function checkForm() {
        // Lấy giá trị từ các trường nhập liệu
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const address = document.getElementById('address').value;

        // Lấy các phần tử thông báo lỗi
        const name_err = document.querySelector('.name_err');
        const email_err = document.querySelector('.email_err');
        const phone_err = document.querySelector('.phone_err');
        const address_err = document.querySelector('.address_err');

        let isValid = true;

        // Kiểm tra tên
        if(name.trim() === "") {
            name_err.textContent = "Vui lòng nhập tên";
            isValid = false;
        } else {
            name_err.textContent = "";
        }

        // Kiểm tra địa chỉ
        if(address.trim() === "") {
            address_err.textContent = "Vui lòng nhập địa chỉ";
            isValid = false;
        } else {
            address_err.textContent = "";
        }

        // Kiểm tra email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(email.trim() === "") {
            email_err.textContent = "Vui lòng nhập email";
            isValid = false;
        } else if (!emailPattern.test(email)) {
            email_err.textContent = "Email không hợp lệ";
            isValid = false;
        } else {
            email_err.textContent = "";
        }

        // Kiểm tra số điện thoại
        const phonePattern = /^0\d{9}$/;
        if(phone.trim() === "") {
            phone_err.textContent = "Vui lòng nhập số điện thoại";
            isValid = false;
        } else if (!phonePattern.test(phone)) {
            phone_err.textContent = "Số điện thoại không hợp lệ. Phải bắt đầu bằng số 0 và có 10 chữ số.";
            isValid = false;
        } else {
            phone_err.textContent = "";
        }

        // Trả về false nếu form không hợp lệ để ngăn chặn gửi form
        return isValid;
    }
</script>
@endsection

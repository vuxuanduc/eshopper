@extends('clients.master_layout')
@section('css')
    
@endsection
@section('slider')
<div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($banners as $banner)
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="{{ asset($banner->banner_url) }}" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First
                                        Order</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div> 
@endsection

@section('content')
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>



<!-- Categories Start -->
{{-- <div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="{{ asset('img/cat-1.jpg') }}" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Men's dresses</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="{{ asset('img/cat-2.jpg') }}" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Women's dresses</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="{{ asset('img/cat-3.jpg') }}" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Baby's dresses</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="{{ asset('img/cat-4.jpg') }}" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Accerssories</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="{{ asset('img/cat-5.jpg') }}" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Bags</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="{{ asset('img/cat-6.jpg') }}" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Shoes</h5>
            </div>
        </div>
    </div>
</div> --}}
<!-- Categories End -->


<!-- Offer Start -->
<div class="container-fluid offer pt-5">
    <div class="row px-xl-5">
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                <img src="{{ asset('img/offer-1.png') }}" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                <img src="{{ asset('img/offer-2.png') }}" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->


<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sản phẩm giảm giá</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach ($saleProducts as $saleProduct)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="{{ asset($saleProduct->avatar) }}" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">{{ $saleProduct->name_product }}</h6>
                    <div class="d-flex justify-content-center">
                        <h6>${{ $saleProduct->new_price }}</h6>
                        <h6 class="text-muted ml-2"><del>${{ $saleProduct->price }}</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="{{ url('detail-product', ['product_id' => $saleProduct->id]) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Chi tiết</a>
                    <form action="{{ url('addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $saleProduct->id }}">
                        <input type="hidden" name="name_product" value="{{ $saleProduct->name_product }}">
                        <input type="hidden" name="image" value="{{ $saleProduct->avatar }}">
                        <input type="hidden" name="price" value="{{ $saleProduct->new_price != "" ? $saleProduct->new_price : $saleProduct->price }}">
                        <button type="submit" class="btn btn-sm text-dark p-0"><i
                            class="fas fa-shopping-cart text-primary mr-1"></i>Thêm giỏ hàng</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sản phẩm mới</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach ($newProducts as $newProduct)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="{{ asset($newProduct->avatar) }}" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">{{ $newProduct->name_product }}</h6>
                    <div class="d-flex justify-content-center">
                        <h6>${{ $newProduct->new_price }}</h6>
                        <h6 class="text-muted ml-2"><del>${{ $newProduct->price }}</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="{{ url('detail-product/' .$newProduct->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Chi tiết</a>
                    <form action="{{ url('addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $newProduct->id }}">
                        <input type="hidden" name="name_product" value="{{ $newProduct->name_product }}">
                        <input type="hidden" name="image" value="{{ $newProduct->avatar }}">
                        <input type="hidden" name="price" value="{{ $newProduct->new_price != "" ? $newProduct->new_price : $newProduct->price }}">
                        <button type="submit" class="btn btn-sm text-dark p-0"><i
                            class="fas fa-shopping-cart text-primary mr-1"></i>Thêm giỏ hàng</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('script')
    
@endsection


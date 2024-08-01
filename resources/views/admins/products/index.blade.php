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
                <th>Product Name</th>
                <th>Category Name</th>
                <th>Avatar</th>
                <th>Description</th>
                <th style="width: 70px;">O-Price</th>
                <th style="width: 70px;">N-Price</th>
                <th>Has Variants</th>
                <th>Is Active</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td class="name-product">{{ $product->name_product }}</td>
                <td>{{ $product->category->category_name }}</td>
                <td>
                  <img src="{{ asset($product->avatar) }}" width="80px" alt="Ảnh sản phẩm {{ $product->name_product }}">
                </td>
                <td class="description">
                  <div>
                      {!! $product->description !!}
                  </div>
                </td>
                <td>
                  <span class="badge bg-danger">{{ $product->price }}</span>
                </td>
                <td>
                    <span class="badge bg-info" style="border-radius: 5px;">{{ $product->new_price == "" ? "Null" : $product->new_price}}</span>
                </td>
                <td>
                    <span class="badge {{ $product->has_variants == false ? "bg-warning" : "bg-success" }}">{{ $product->has_variants == false ? "No variant" : "Is variant" }}</span>
                </td>
                <td>
                    <span class="badge {{ $product->is_active == 0 ? "bg-success" : "bg-danger" }}">{{ $product->is_active == 0 ? "Is active" : "Temporary lock" }}</span>
                </td>
                <td>
                  <span class="d-flex">
                    <a class="text-primary" href="{{ route('products.edit', ['product' => $product->id]) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                    <form method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}">
                      @csrf
                      @method("DELETE")
                      <button onclick="return confirm('Xác nhận xóa ?')" class="text-danger mx-2" style="margin-top: -2px;background-color: transparent;border: none;"><i class="fa-solid fa-trash"></i></button>
                    </form>
                  </span>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </section>
    <div class="d-flex justify-content-between">
      <div>
        <a href="{{ route('products.create') }}" style="font-size: 14px;" class="btn btn-primary">Add</a>
      </div>
      <div>
        {{ $products->links() }}
      </div>
    </div>
  </main>
@endsection
@section('script')
    
@endsection
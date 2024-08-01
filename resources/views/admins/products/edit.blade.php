@extends('admins.master_layout')

@section('css')
    <style>
      form {
        font-size: 14px;
      }
      #nameProduct, #category, #avatar, #price, #newPrice, #has_variants, #is_active{
        font-size: 14px;
      }
      input::placeholder {
        font-size: 14px;
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
    </div>
    @include('auth._message')
    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <form method="post" action="{{ route('products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="nameProduct" class="col-sm-2 col-form-label fw-bold">Name product</label>
                    <input type="text" id="nameProduct" value="{{ $product->name_product }}" name="name_product" placeholder="Name product..." class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="category" class="col-sm-2 col-form-label fw-bold">Name category</label>
                    <select name="category_id" id="category" class="form-select">
                        <option value="">Select category</option>
                        @foreach($options as $id => $name)
                            <option {{ $product->category_id == $id ? 'selected' : '' }} value="{{ $id }}">{!! $name !!}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <img src="{{ asset($product->avatar) }}" width="100%" alt="" />
                  </div>
                  <div class="col-sm-10">
                    <label for="avatar" class="col-sm-2 col-form-label fw-bold">Avatar</label>
                    <input type="file" name="avatar" id="avatar" accept="image/*" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="price" class="col-sm-2 col-form-label fw-bold">Price</label>
                    <input type="text" name="price" value="{{ $product->price }}" id="price" placeholder="Price product..." class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="newPrice" class="col-sm-2 col-form-label fw-bold">New price</label>
                    <input type="text" name="new_price" value="{{ $product->new_price }}" id="newPrice" placeholder="New price product..." class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="description" class="col-sm-2 col-form-label fw-bold">Description</label>
                    <textarea name="description" id="description" rows="10" cols="80" placeholder="Description...">
                      {{ $product->description }}
                    </textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="has_variants" class="col-sm-2 col-form-label fw-bold">Has variant</label>
                    <select name="has_variants" id="has_variants" class="form-select">
                      <option {{ $product->has_variants == 0 ? 'selected' : '' }} value="0">No variant</option>
                      <option {{ $product->has_variants == 1 ? 'selected' : '' }} value="1">Is variant</option>
                  </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="is_active" class="col-sm-2 col-form-label fw-bold">Status product</label>
                    <select name="is_active" id="is_active" class="form-select">
                      <option {{ $product->is_active == 0 ? 'selected' : '' }} value="0">Is active</option>
                      <option {{ $product->is_active == 1 ? 'selected' : '' }} value="1">Temporary lock</option>
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
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
  // Initialize CKEditor
  CKEDITOR.replace('description');
</script>
@endsection
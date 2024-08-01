@extends('admins.master_layout')

@section('css')
    <style>
      form {
        font-size: 14px;
      }
      #statusCategory, #categoryParentId {
        font-size: 14px;
      }
      #nameCategory::placeholder, #nameCategory {
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
    </div><!-- End Page Title -->
    @include('auth._message')

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <form method="post" action="{{ route('categories.update', ['category' => $category->id]) }}">
                @csrf
                @method("PUT")
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="nameCategory" class="col-sm-2 col-form-label fw-bold">Name category</label>
                    <input type="text" class="form-control" value="{{ $category->category_name }}" id="nameCategory" placeholder="Name category..." name="category_name">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="categoryParentId" class="col-sm-5 col-form-label fw-bold">Name parent category</label>
                    <select name="category_parent_id" id="categoryParentId" class="form-select">
                      <option value="">Select parent category</option>
                      @foreach($options as $id => $name)
                          <option {{ $category->category_parent_id == $id ? 'selected' : '' }} value="{{ $id }}">{!! $name !!}</option>
                      @endforeach
                  </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="statusCategory" class="col-sm-5 col-form-label fw-bold">Status category</label>
                    <select name="is_active" id="statusCategory" class="form-select">
                        <option {{ $category->is_active == 0 ? 'selected' : '' }} value="0">Is active</option>
                        <option {{ $category->is_active == 1 ? 'selected' : '' }} value="1">Temporarily locked</option>
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
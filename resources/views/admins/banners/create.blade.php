@extends('admins.master_layout')

@section('css')
<style>
  form {
    font-size: 14px;
  }
  #statusBanner {
    font-size: 14px;
  }
  #selectImage {
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

              <form method="post" action="{{ route('banners.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="selectImage" class="fw-bold">Select image</label> <span class="err text-danger mx-2 banner_url_err"></span>
                    <input type="file" id="selectImage" name="banner_url" class="form-control mt-2">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="statusBanner" class="fw-bold">Status banner</label><span class="err text-danger mx-2 is_active_err"></span>
                    <select name="is_active" id="statusBanner" class="form-select mt-2">
                        <option value="1">Is active</option>
                        <option value="0">Temporarily locked</option>
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
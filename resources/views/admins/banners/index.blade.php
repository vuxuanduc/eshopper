@extends('admins.master_layout')

@section('css')
    <style>
      tbody {
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
      <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Banner</th>
                <th>Is Active</th>
                @if (!empty($permissionEditBanner) || !empty($permissionDeleteBanner))
                  <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
          @foreach ($banners as $banner)
              <tr>
                <td>
                  {{ $banner->id}}
                </td>
                <td>
                {{-- {{$banner->banner_url}} --}}
                    <img src="{{ asset($banner->banner_url) }}" width="100px" alt="" />
                </td>
                <td>
                    <span class="badge {{ $banner->is_active == 0 ? "bg-danger" : "bg-success" }}">{{ $banner->is_active == 1 ? "Is active" : "Temporarily locked" }}</span>
                </td>
                @if (!empty($permissionEditBanner) || !empty($permissionDeleteBanner))
                  <td>
                    <span class="d-flex">
                      @if (!empty($permissionEditBanner))
                      <a class="text-primary" href="{{ route('banners.edit', ['banner' => $banner->id]) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                    @endif
                    @if (!empty($permissionDeleteBanner))
                      <form method="POST" action="{{ route('banners.destroy', ['banner' => $banner->id]) }}">
                        @csrf
                        @method("DELETE")
                        <button onclick="return confirm('Xác nhận xóa ?')" class="text-danger mx-2" style="margin-top: -2px;background-color: transparent;border: none;"><i class="fa-solid fa-trash"></i></button>
                      </form>
                    @endif
                    </span>
                  </td>
                @endif
              </tr>
          @endforeach
        </tbody>
      </table>
    </section>
    <div class="d-flex justify-content-between">
      <div>
        @if (!empty($permissionAddBanner))
          <a href="{{ route('banners.create') }}" class="btn btn-primary" style="font-size: 14px;">Add</a>
        @endif
      </div>
      {{ $banners->links() }}
    </div>
  </main>
@endsection


@section('script')
    
@endsection
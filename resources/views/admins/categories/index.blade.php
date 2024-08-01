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
            <th>Category Name</th>
            <th>Parent Category</th>
            <th>Is Active</th>
            @if (!empty($permissionEditCategory) || !empty($permissionDeleteCategory))
              <th>Action</th>
            @endif
        </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->category_name }}</td>
                <td>
                  {{ $category->parent ? $category->parent->category_name : "Null" }}
                </td>
                <td>
                  <span class="badge {{ $category->is_active == 0 ? "bg-success" : "bg-danger" }}">{{ $category->is_active == 0 ? "Is active" : "Temporarily locked" }}</span>
                </td>
                @if (!empty($permissionEditCategory) || !empty($permissionDeleteCategory))
                  <td>
                    <span class="d-flex">
                      @if (!empty($permissionEditCategory))
                      <a class="text-primary" href="{{ route('categories.edit', ['category' => $category->id]) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                    @endif
                    @if (!empty($permissionDeleteCategory))
                      <form method="POST" action="{{ route('categories.destroy', ['category' => $category->id]) }}">
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
        <a href="{{ route('categories.create') }}" style="font-size: 14px;" class="btn btn-primary">Add</a>
      </div>
      {{ $categories->links() }}
    </div>
  </main>
@endsection


@section('script')
    
@endsection
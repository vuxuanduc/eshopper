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
                <th>Name</th>
                <th>Date</th>
                @if (!empty($permissionEditRole) || !empty($permissionDeleteRole))
                  <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
          @foreach ($roles as $role)
            <tr>
              <td>{{ $role->id }}</td>
              <td>{{ $role->name_role }}</td>
              <td>{{ $role->created_at }}</td>
              @if (!empty($permissionEditRole) || !empty($permissionDeleteRole))
              <td>
                <span class="d-flex">
                  {{-- @if (!empty($permissionEditRole) && $role->id != 2 && $role->id != 1) --}}
                  <a class="text-primary" href="{{ route('roles.edit', ['role' => $role->id]) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                {{-- @endif --}}
                @if (!empty($permissionDeleteRole) && $role->id != 2 && $role->id != 1)
                  <form method="POST" action="{{ route('roles.destroy', ['role' => $role->id]) }}">
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
    @if (!empty($permissionAddRole))
      <a href="{{ route('roles.create') }}" style="font-size: 14px;" class="btn btn-primary">Add</a>
    @endif
  </main>
@endsection


@section('script')
    
@endsection
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
                <th>Email</th>
                <th>Role</th>
                <th>Is_Active</th>
                @if (!empty($permissionEditUser) || !empty($permissionDeleteUser))
                  <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name_role }}</td>
                <td>
                  <span class="badge {{ $user->is_active == 0 ? "bg-success" : "bg-danger" }}">{{ $user->is_active == 0 ? "Is active" : "Temporarily locked" }}</span>
                </td>
                @if (!empty($permissionEditUser) || !empty($permissionDeleteUser))
                  <td class="d-flex">
                    @if (!empty($permissionEditUser))
                    <a class="text-primary" href="{{ route('users.edit', ['user' => $user->id]) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                    @endif
                    @if (!empty($permissionDeleteUser))
                      <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
                        @csrf
                        @method("DELETE")
                        <button onclick="return confirm('Xác nhận xóa ?')" class="text-danger mx-2" style="margin-top: -2px;background-color: transparent;border: none;"><i class="fa-solid fa-trash"></i></button>
                      </form>
                    @endif
                  </td>
                @endif
              </tr>
          @endforeach
        </tbody>
      </table>
    </section>
    @if (!empty($permissionAddUser))
      <a href="{{ route('users.create') }}" style="font-size: 14px;" class="btn btn-primary">Add</a>
    @endif
  </main>
@endsection

@section('script')
    
@endsection
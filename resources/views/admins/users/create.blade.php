@extends('admins.master_layout')

@section('css')
    <style>
      form{
        font-size: 14px;
      }
      input::placeholder {
        font-size: 14px;
      }
      #roleId {
          font-size:14px;
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

              <form method="post" action="{{ route('users.store') }}">
                @csrf
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Name</label>
                    <input type="text" class="form-control" id="inputText" placeholder="Name..." name="name">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Email</label>
                    <input type="text" class="form-control" placeholder="Email..." id="inputText" name="email">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Password</label>
                    <input type="password" placeholder="Password..." class="form-control" id="inputText" name="password">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="roleId" class="col-sm-2 col-form-label fw-bold">Role</label>
                    <select name="role_id" id="roleId" class="form-select">
                     @foreach ($roles as $role)
                      <option value="{{ $role->id }}">{{ $role->name_role }}</option>
                     @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label for="roleId" class="col-sm-2 col-form-label fw-bold">Status user</label>
                    <select name="is_active" id="roleId" class="form-select">
                      <option value="0">Is_active</option>
                      <option value="1">Temporarily locked</option>
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
@extends('admins.master_layout')

@section('css')
    <style>
      form {
        font-size: 14px;
      }
      #nameRole {
        font-size: 14px;
      }
      #nameRole::placeholder {
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

              <form method="post" action="{{ route('roles.store') }}">
                @csrf
                <div class="row mb-3">
                  <div class="col-sm-10">
                  <label for="nameRole" class="col-sm-2 col-form-label fw-bold">Name role</label>
                    <input type="text" class="form-control" id="nameRole" placeholder="Name role..." name="name_role">
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-12 col-form-label"><b>Permissions</b></label>
                  
                    @foreach ($getPermissions as $value)
                    <div class="row my-2">
                        <div class="col-md-2" style="font-weight: 600">
                          {{ $value['name'] }}
                        </div>
                        <div class="col-md-10">
                          <div class="row">
                            @foreach($value['group'] as $group)
                              <div class="col-md-3">
                                <label><input style="margin-right: 3px" value="{{ $group['id'] }}" type="checkbox" name="permission_id[]">{{ $group['name'] }}</label>
                              </div>
                          @endforeach
                          </div>
                        </div>
                    </div>
                    <hr style="margin-top: 15px">
                    @endforeach
                  
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
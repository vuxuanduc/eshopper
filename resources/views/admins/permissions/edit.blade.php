@extends('admins.master_layout')

@section('css')
    
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

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <form method="post" action="{{ route('roles.update', ['role' => $role->id]) }}">
                @csrf
                @method("PUT")
                <div class="row mb-3">
                  <div class="col-sm-10">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Name role</label>
                    <input type="text" value="{{ $role->name_role }}" class="form-control" id="inputText" name="name_role">
                  </div>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary" style="font-size: 15px">Submit</button></div>
              </form><!-- End Horizontal Form -->

            </div>
          </div>
    </section>
  </main>
@endsection


@section('script')
    
@endsection
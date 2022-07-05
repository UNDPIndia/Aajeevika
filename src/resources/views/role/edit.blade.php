@extends('layouts.app')
@section('title', 'View Stakeholders | UNDP')
@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
    <h1>UNDP</h1>
    </div>
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item active"><a href="#">Home</a></li>
    </ol>
    </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
  
  <section class="content">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit Role</h3>
  
          </div>
          <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('admin/updaterole') }}/{{ $id }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="">Role Name : </label>
                        <input type="text" name="role_name" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" id="" value="{{ $roleDetail->role_name }}" required autofocus>
                        
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>

                        @endif

                    </div>
                </div>
                <div class="row">    
                    <div class="form-group col-sm-6">
                        <button type="submit" class="btn btn-outline-primary">Save Role</button>
                    </div>
                </div>
              </form>
          </div>
          <div class="card-footer">
              
          </div>
      </div>
  
  </section>

@endsection
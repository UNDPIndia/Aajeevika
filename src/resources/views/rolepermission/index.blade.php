@extends('layouts.app')

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
            <h3 class="card-title"> ( {{ $role->role_name }} ) Update Permission in user (This Manager is to manage Permission.)</h3>

            <!-- <a href="{{ url('admin/addpermission') }}" class="btn btn-outline-primary float-sm-right">Add New Permission</a> -->
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <form action="{{ url('admin/addrolepermission') }}/{{ $role->id }}" method="post">
                @csrf;  
              <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th> Permission Name</th>
                      <th> Url </th>
                      <th> Action </th>

                    </tr>
                  </thead>
                  <tbody>
                      @php
                        $i = 1;
                        
                        @endphp
                        @foreach ($rolePermission as $key => $item)
                        @php 
                          $permissionId = $item->id; 
                        
                        @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{$item->permission_name}}</td>
                        <td>
                        {{$item->url}}
                        </td>
                        <td>
                                <input type="checkbox" name="permision[]" value="{{ $item->id }}" @if(in_array($permissionId ,$assignedpermission))  checked  @endif id="">
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                    @endforeach
                  </tbody>
                </table>
                <button type="submit">Add Permission</button>
              </form>
            </div>
          </div>
          <div class="card-footer">

          </div>
      </div>

  </section>

@endsection


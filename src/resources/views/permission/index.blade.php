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
            <h3 class="card-title">Permission  (This Manager is to manage Permission.)</h3>
            <a href="{{ url('admin/addpermission') }}" class="btn btn-outline-primary float-sm-right">Add New Permission</a>
          </div>
          <div class="card-body">

                  <div class="table-responsive">
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
                            @foreach ($permissionList as $key => $item)

                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$item->permission_name}}</td>
                            <td>
                            {{$item->url}}
                            </td>
                            <td>
                                    <a href="{{ url('admin/editpermission') }}/{{ $item->id }}" class="btn btn-primary">Edit</a>
                                @if($item->status == 1)
                                    <a href="{{ url('admin/removepermission') }}/{{ $item->id }}/0" class="btn btn-danger btn-sm">Remove Permission</a>
                                    @else
                                    <a href="{{ url('admin/removepermission') }}/{{ $item->id }}/1" class="btn btn-success btn-sm">Enable Permission</a>

                                @endif
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                      </tbody>
                    </table>
                    {{ $permissionList->links() }}
                </div>
          </div>
          <div class="card-footer">

          </div>
      </div>

  </section>

@endsection


@extends('layouts.admin-app')

@section('content')
  <!-- BEGIN CONTENT PART -->
  <div id="content" class="main-content">
    <div class="container">
      <div class="page-header">
        <div class="page-title">
          <h3>Product Documentation</h3>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-lg-12 col-md-12 layout-spacing">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                    <h4>Docs List</h4>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                    <a href="{{ route('admin.docs.create') }}" class="btn btn-primary btn-rounded mt-3 mr-4"><i
                            class="flaticon-plus"></i> Add Docs</a>
                </div>
              </div>
              <hr />

            </div>
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! session('success') !!}
                </div>
            @endif
            <div class="widget-content widget-content-area">
              <div class="table-responsive">
                <table id="zero-config" class="table table-bordered table-hover table-condensed mb-4">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Category</th>
                      <th>Image</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($docs as $index=>$doc)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $doc->name }}</td>
                        <td>{{ $doc->code }}</td>
                        <td>{{ $doc->category }}</td>
                        <td>
                          @if($doc->image)
                            <img src="{{ asset('storage/' . $doc->image) }}" width="80">
                          @endif
                        </td>
                        <td>
                          <a href="{{ route('admin.docs.edit', $doc->id) }}" class="btn btn-sm btn-primary">Edit</a>
                          <form action="{{ route('admin.docs.destroy', $doc->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>

                </table>
              </div>

              
              <div class="d-flex justify-content-end">

              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
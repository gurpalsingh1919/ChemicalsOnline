@extends('layouts.admin-app')

@section('content')
  <!-- BEGIN CONTENT PART -->
  <div id="content" class="main-content">
    <div class="container">
      <div class="page-header">
        <div class="page-title">
          <h3>Categories</h3>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-lg-12 col-md-12 layout-spacing">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                    <h4>Category List</h4>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-rounded mt-3 mr-4"><i
                            class="flaticon-plus"></i> Add Category</a>
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
                      <th>Parent Category</th>
                      <th>Products</th>
                      <th class="align-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($categories as $index => $category)
                  <tr>
                    <td>{{  $index + 1  }}</td>
                    <td>{{ ucfirst($category->name) }}</td>
                    <td>             
                      @if ($category->parent)
                         {{ $category->parent->name}}
                      @endif
                    </td>
                    <td><a href="{{route('admin.categories.show',$category->id)}}" class="badge badge-info shadow-none badge-pill">View Products</a></td>
                    <td class="text-center">
                      <ul class="table-controls">
                        
                        <li><a href="{{ route('admin.categories.edit', $category->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="flaticon-edit  bg-success p-1 text-white br-6 mb-1"></i></a></li>
                        <li>
                          <form action="{{ route('admin.categories.destroy', $category->id) }}" style="display:inline;" method="POST">
                            @csrf @method('DELETE')
                            <button data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" type="submit" onclick="return confirm('Delete this category?')"><i class="flaticon-delete  bg-danger p-1 text-white br-6 mb-1"></i></button>
                          </form>
                        </li>
                      </ul>
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
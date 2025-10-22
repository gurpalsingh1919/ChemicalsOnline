@extends('layouts.admin-app')

@section('content')
<div id="content" class="main-content">
  <div class="container mt-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Import Products</h3>
    </div>

    {{-- Alerts --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Error:</strong> Please check the form for issues.
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! session('success') !!}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- Add Product Form --}}
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Import Products</h5>
          
      </div>
      <form id="productForm" method="POST" action="{{ route('admin.import_save') }}" enctype="multipart/form-data">
          @csrf
        <div class="card-body">
          <div class="form-row">
              <div class="form-group col-md-6 pr-4">
                  <label>Upload CSV file <span class="text-danger">*</span></label>
                  <input type="file" name="csv_file" class="form-control" required>
                  @error('csv_file')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
              </div>
               <div class="form-group col-md-6 pt-2 mt-4">
              <button type="submit" class="btn btn-primary btn-sm px-4 py-2 font-weight-bold" form="productForm">
                <i class="fas fa-file-import mr-1"></i> import
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection

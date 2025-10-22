@extends('layouts.admin-app')

@section('content')
    <style>
    .dropdown-header .text {
          color: #000;
          font-size: 20px;
          font-weight: bold;
      }
    </style>

    <div id="content" class="main-content">
        <div class="container mt-4">

            {{-- Page Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">Edit Product</h3>
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

            {{-- Edit Product Form --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Product</h5>
                    <a href="{{ route('admin.all_products') }}" id="edittt" class="btn btn-secondary btn-rounded"><i class="icon-back position-left"></i> Back</a>
                   
                </div>

                <form id="productForm" method="POST" action="{{ route('admin.update-product', $product->id) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6 pr-4">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="Enter Name" class="form-control"
                                    value="{{ $product->name }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Product price <span class="text-danger">*</span></label>
                                <input type="text" name="price" placeholder="Enter product price" class="form-control"
                                    value="{{ $product->price }}">
                            </div>

                            <div class="form-group col-md-6 pr-4">
                                <label>SKU <span class="text-danger">*</span></label>
                                <input type="text" name="sku" placeholder="Enter SKU" class="form-control"
                                    value="{{ $product->sku }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Variant <span class="text-danger">*</span></label>
                                <input type="text" name="variant" placeholder="Enter variant" class="form-control"
                                    value="{{ $product->variant }}">
                            </div>
                             <!-- Multi-select categories -->
                            <div class="form-group">
                                <label for="categories">Categories & Sub Categories</label>
                                <select name="categories[]" id="categories" class="form-control selectpicker" multiple>
                                    @foreach($categories as $parent)
                                        <optgroup label="{{ $parent->name }}">
                                            <!-- Parent category itself -->
                                            <option value="{{ $parent->id }}"
                                                {{ in_array($parent->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $parent->name }}
                                            </option>

                                            <!-- Child categories -->
                                            @foreach($parent->children as $child)
                                                <option value="{{ $child->id }}"
                                                    {{ in_array($child->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    -- {{ $child->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6 d-flex">
                              <div class="col-md-6">
                                <label>Option 1 Name</label>
                                <input type="text" name="option_1[name]" placeholder="Option 1 name" class="form-control" value="{{ $product->option1['name'] }}">
                              </div>
                              <div class="col-md-6">
                                <label>Option 1 Value</label>
                                <input type="text" name="option_1[value]" placeholder="Option 1 value" class="form-control" value="{{ $product->option1['value'] }}">
                              </div>
                            </div>
                            <div class="form-group col-md-6 d-flex">
                              <div class="col-md-6">
                                <label>Option 2 Name</label>
                                <input type="text" name="option_2[name]" placeholder="Option 2 name" class="form-control" value="{{ $product->option2['name'] }}">
                              </div>
                              <div class="col-md-6">
                                <label>Option 2 Value</label>
                                <input type="text" name="option_2[value]" placeholder="Option 2 value" class="form-control" value="{{ $product->option2['value'] }}">
                              </div>
                            </div>
                            <div class="form-group col-md-6 d-flex">
                              <div class="col-md-6">
                                <label>Option 3 Name</label>
                                <input type="text" name="option_3[name]" placeholder="Option 3 name" class="form-control" value="{{ (isset($product->option3['name']))?$product->option3['name']:'' }}">
                              </div>
                              <div class="col-md-6">
                                <label>Option 3 Value</label>
                                <input type="text" name="option_3[value]" placeholder="Option 3 value" class="form-control" value="{{ (isset($product->option3['value']))?$product->option3['value']:'' }}">
                              </div>
                            </div>

                            

                            <div class="form-group col-md-12 pr-4">
                                <label>Description <span class="text-danger">*</span></label>
                                
                                <input type="hidden" name="description" id="description" value="{{$product->description}}">
                              <div class="summernote">
                                  
                              </div>
                            </div>


                             <button type="submit" id="save" class="btn btn-primary px-4 py-2 font-weight-bold" form="productForm">
                                <i class="fas fa-save mr-1"></i> Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    {{-- jQuery --}}
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script>
    // $(document).ready(function() {
    //     $('#categories').select2({
    //         placeholder: "Select Categories & Sub Categories",
    //         allowClear: true
    //     });
    // });
</script>
@endsection
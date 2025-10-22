@extends('layouts.admin-app')

@section('content')
    <style>
        .multiline-box {
            background: #fdfdfd;
            border: 1px solid #ced4da;
            padding: 10px;
            border-radius: 0.25rem;
            font-family: 'Courier New', Courier, monospace;
            min-height: 120px;
            resize: vertical;
        }

        .multiline-box:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }
    </style>
    <div id="content" class="main-content">
        <div class="container mt-4">

            {{-- Page Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">Manage Products</h3>
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
                    <h5 class="mb-0">Add Product</h5>
                    <button type="submit" class="btn btn-success px-4 py-2 font-weight-bold" form="productForm">
                        <i class="fas fa-save mr-1"></i> Save
                    </button>
                </div>
                <form id="productForm" method="POST" action="{{ route('admin.save_product') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">

                            <div class="form-group col-md-6 pr-4">
                                <label>Chemical Name <span class="text-danger">*</span></label>
                                <input type="text" name="chemical_name" class="form-control"
                                    placeholder="Enter Chemical Name" value="{{ old('chemical_name') }}">
                                @error('chemical_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>Product Code <span class="text-danger">*</span></label>
                                <input type="text" name="product_code" class="form-control" placeholder="Enter Product Code"
                                    value="{{ old('product_code') }}">
                                @error('product_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 pr-4">
                                <label>Brand Name <span class="text-danger">*</span></label>
                                <input type="text" name="brand_name" class="form-control" placeholder="Enter Brand Name"
                                    value="{{ old('brand_name') }}">
                                @error('brand_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>CAS Number <span class="text-danger">*</span></label>
                                <input type="text" name="cas_number" class="form-control" placeholder="Enter CAS Number"
                                    value="{{ old('cas_number') }}">
                                @error('cas_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 pr-4">
                                <label>Appearance</label>
                                <input type="text" name="appearance" class="form-control" placeholder="Enter Appearance"
                                    value="{{ old('appearance') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Storage</label>
                                <input type="text" name="storage" class="form-control"
                                    placeholder="Enter Storage Instructions" value="{{ old('storage') }}">
                            </div>

                            <div class="form-group col-md-6 pr-4">
                                <label>Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control multiline-box" rows="3"
                                    placeholder="Enter Description">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>Function</label>
                                <textarea name="function" class="form-control multiline-box" rows="3"
                                    placeholder="Enter Function">{{ old('function') }}</textarea>
                            </div>

                            {{-- Tags Input Fields --}}
                            <div class="form-group col-md-6 pr-4">
                                <label>Synonyms</label>
                                <input type="text" name="synonyms" data-role="tagsinput" class="form-control"
                                    placeholder="Enter Synonyms (press Enter or comma after each)">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Formula</label>
                                <input type="text" name="formula"  class="form-control"
                                    placeholder="Enter Formula">
                            </div>

                            {{-- Packages --}}
                            <div class="form-group col-md-6 pr-4">
                                <label>Packages</label>
                                <div id="packages-wrapper">
                                    <div class="input-group mb-2">
                                        <input type="text" name="packages[]" class="form-control"
                                            placeholder="Enter Package">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger remove-field d-none" type="button">&times;</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-primary add-field"
                                    data-wrapper="#packages-wrapper" data-placeholder="Enter Package">+ Add Package</button>
                            </div>

                            {{-- Industries --}}
                            <div class="form-group col-md-6">
                                <label>Industries</label>
                                <div id="industries-wrapper">
                                    <div class="input-group mb-2">
                                        <input type="text" name="industries[]" class="form-control"
                                            placeholder="Enter Industry">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger remove-field d-none" type="button">&times;</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-primary add-field"
                                    data-wrapper="#industries-wrapper" data-placeholder="Enter Industry">+ Add Industry</button>
                            </div>

                            {{-- Product Classes --}}
                            <div class="form-group col-md-6 pr-4">
                                <label>Product Classes</label>
                                <div id="product_classes-wrapper">
                                    <div class="input-group mb-2">
                                        <input type="text" name="product_classes[]" class="form-control"
                                            placeholder="Enter Product Class">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger remove-field d-none" type="button">&times;</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-primary add-field"
                                    data-wrapper="#product_classes-wrapper" data-placeholder="Enter Product Class">+ Add Product Class</button>
                            </div>

                            {{-- Other --}}
                            <div class="form-group col-md-6">
                                <label>Other</label>
                                <div id="other-wrapper">
                                    <div class="input-group mb-2">
                                        <input type="text" name="other[]" class="form-control"
                                            placeholder="Enter Other Detail">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger remove-field d-none" type="button">&times;</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-primary add-field" data-wrapper="#other-wrapper"
                                    data-placeholder="Enter Other Detail">+ Add Other</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
           
            $('.add-field').click(function () {
                var wrapper = $($(this).data('wrapper'));
                var placeholder = $(this).data('placeholder');
                var fieldName = wrapper.attr('id').replace('-wrapper', '');

                var newInput = `
                    <div class="input-group mb-2">
                        <input type="text" name="${fieldName}[]" class="form-control" placeholder="${placeholder}">
                        <div class="input-group-append">
                            <button class="btn btn-danger remove-field" type="button">&times;</button>
                        </div>
                    </div>
                `;
                wrapper.append(newInput);
                updateRemoveButtons(wrapper);
            });

           
            $(document).on('click', '.remove-field', function () {
                var wrapper = $(this).closest('div[id$="-wrapper"]');
                $(this).closest('.input-group').remove();
                updateRemoveButtons(wrapper);
            });

            
            function updateRemoveButtons(wrapper) {
                var inputs = wrapper.find('.input-group');
                inputs.find('.remove-field').addClass('d-none'); 
                inputs.slice(1).find('.remove-field').removeClass('d-none'); 
            }

           
            $('div[id$="-wrapper"]').each(function () {
                updateRemoveButtons($(this));
            });
        });
    </script>
@endsection

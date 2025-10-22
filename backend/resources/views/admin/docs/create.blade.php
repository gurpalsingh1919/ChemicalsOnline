@extends('layouts.admin-app')

@section('content')
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
   <div class="container">
      <div class="page-header">
         <div class="page-title">
            <h3>Product Documentation</h3>
         </div>
      </div>
      @if($errors->all())
               @foreach ($errors->all() as $error)
                @if($loop->index==0)
                  <div class="alert alert-danger">One or more fields have an error. Please check and try again.</div>
                @endif
              @endforeach
            @endif
            @if(session('error')) 
              <div class="error alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error : </strong>   {{ session('error') }}
              </div>
            @endif
            @if(session('success')) 
              <div class="error alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {!! session('success') !!}
              </div>
            @endif

      <form method="post" action="{{ route('admin.docs.store') }}" enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-lg-12 col-md-12 layout-spacing">
               <div class="statbox widget box box-shadow">
                 <div class="widget-header">
                     <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                           <h4>Add Docs</h4>
                        </div>  
                         <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right mt-4">
                       <a href="{{url('admin/docs')}}" class="btn btn-primary btn-rounded"><i class="icon-pencil position-left"></i>All Docs</a>
                       
                    </div>                     
                     </div>
                    

                     <hr/>
                 </div>
                 <div class="widget-content widget-content-area">
                     <div class="row">
                        {{-- Name --}}
                        <div class="col-lg-6 mb-2">
                          <h5>Name <span class="text-danger">*</span></h5>
                          <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                          @if ($errors->has('name'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                          @endif
                        </div>

                        {{-- Code --}}
                        <div class="col-lg-6 mb-2">
                          <h5>Code <span class="text-danger">*</span></h5>
                          <input type="text" name="code" class="form-control" placeholder="Code" value="{{ old('code') }}">
                          @if ($errors->has('code'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('code') }}</strong></span>
                          @endif
                        </div>

                        {{-- Category --}}
                        <div class="col-lg-6 mb-2">
                          <h5>Category <span class="text-danger">*</span></h5>
                          <input type="text" name="category" class="form-control" placeholder="Category" value="{{ old('category') }}">
                          @if ($errors->has('category'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('category') }}</strong></span>
                          @endif
                        </div>

                        {{-- Attributes --}}
                        <div class="col-lg-6 mb-2">
                          <h5>Attributes </h5>
                          <input type="text" name="attributes" value="{{ old('attributes') }}" class="form-control" placeholder="Attributes">
                          @if ($errors->has('attributes'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('attributes') }}</strong></span>
                          @endif
                        </div>

                        {{-- Packaging --}}
                        <div class="col-lg-6 mb-2">
                          <h5>Packaging </h5>
                          <input type="text" name="packaging" class="form-control" placeholder="Packaging" value="{{ old('packaging') }}">
                          @if ($errors->has('packaging'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('packaging') }}</strong></span>
                          @endif
                        </div>

                        {{-- Grades --}}
                        <div class="col-lg-6 mb-2">
                          <h5>Grades </h5>
                          <input type="text" name="grades" class="form-control" placeholder="Grades" value="{{ old('grades') }}">
                          @if ($errors->has('grades'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('grades') }}</strong></span>
                          @endif
                        </div>
                        {{-- Proof Strength --}}
                        <div class="col-lg-6 mb-2">
                          <h5>Proof Strength </h5>
                          <input type="text" name="proof_strength" class="form-control" placeholder="Proof Strength" value="{{ old('proof_strength') }}">
                          @if ($errors->has('proof_strength'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('proof_strength') }}</strong></span>
                          @endif
                        </div>

                        {{-- Formula --}}
                        <div class="col-lg-6 mb-2">
                          <h5>Formula </h5>
                          <input type="text" name="formula" class="form-control" placeholder="Formula" value="{{ old('formula') }}">
                          @if ($errors->has('formula'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('formula') }}</strong></span>
                          @endif
                        </div>

                        {{-- Certification (Image Upload) --}}
                        <div class="col-lg-6 mb-2">
                          <h5>Certification </h5>
                          <input type="file" name="certification" class="form-control" accept="image/*">
                          @if ($errors->has('certification'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('certification') }}</strong></span>
                          @endif
                        </div>

                        {{-- Main Image --}}
                        <div class="col-lg-6 mb-2">
                          <h5>Image </h5>
                          <input type="file" name="image" class="form-control" accept="image/*">
                          @if ($errors->has('image'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('image') }}</strong></span>
                          @endif
                        </div>

                        {{-- Notes --}}
                        <div class="col-lg-12 mb-2">
                          <h5>Notes </h5>
                          <textarea name="notes" class="form-control" placeholder="Notes">{{ old('notes') }}</textarea>
                          @if ($errors->has('notes'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('notes') }}</strong></span>
                          @endif
                        </div>

                        <div class="col-lg-12 mb-2">
                          <h4>Supporting Documents </h4>
                          <div id="document-wrapper">
                            <div class="document-group mb-2 row">
                              <div class="col-md-5">
                                <input type="text" name="supporting_documents[0][name]" class="form-control" placeholder="Document Name">
                              </div>
                              <div class="col-md-5">
                                <input type="file" name="supporting_documents[0][file]" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                              </div>
                              <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-sm remove-doc">Remove</button>
                              </div>
                            </div>
                          </div>
                          <button type="button" class="btn btn-primary btn-sm" id="add-document">Add Another Document</button>

                          @if ($errors->has('supporting_documents'))
                            <span class="invalid-feedback d-block"><strong>{{ $errors->first('supporting_documents') }}</strong></span>
                          @endif
                        </div>
                                       
                     </div>
                     <button type="submit" id="save" class="btn btn-success btn-rounded mr-4"><i class="icon-ok position-left"></i> Save</button>
                  </div>
               </div>
            </div>                    
         </div>
      </form>
   </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const wrapper = document.getElementById('document-wrapper');
  const addBtn = document.getElementById('add-document');
  let docIndex = 1;

  addBtn.addEventListener('click', function () {
    const group = document.createElement('div');
    group.classList.add('document-group', 'mb-2', 'row');
    group.innerHTML = `
      <div class="col-md-5">
        <input type="text" name="supporting_documents[${docIndex}][name]" class="form-control" placeholder="Document Name">
      </div>
      <div class="col-md-5">
        <input type="file" name="supporting_documents[${docIndex}][file]" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
      </div>
      <div class="col-md-2">
        <button type="button" class="btn btn-danger btn-sm remove-doc">Remove</button>
      </div>
    `;
    wrapper.appendChild(group);
    docIndex++;
  });

  wrapper.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-doc')) {
      e.target.closest('.document-group').remove();
    }
  });
});
</script>
@endsection

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
            <form method="POST" action="{{ route('admin.docs.update', $doc->id) }}" enctype="multipart/form-data">
               @csrf @method('PUT')
               <div class="widget-content widget-content-area">
                  <div class="row">
                  {{-- Name --}}
                  <div class="col-lg-6 mb-2">
                    <h5>Name <span class="text-danger">*</span></h5>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $doc->name) }}">
                    @error('name') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                  </div>

                  {{-- Code --}}
                  <div class="col-lg-6 mb-2">
                    <h5>Code <span class="text-danger">*</span></h5>
                    <input type="text" name="code" class="form-control" value="{{ old('code', $doc->code) }}">
                    @error('code') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                  </div>

                  {{-- Category --}}
                  <div class="col-lg-6 mb-2">
                    <h5>Category <span class="text-danger">*</span></h5>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $doc->category) }}">
                    @error('category') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                  </div>

                  {{-- Attributes --}}
                  <div class="col-lg-6 mb-2">
                    <h5>Attributes <span class="text-danger">*</span></h5>
                    <input type="text" name="attributes" class="form-control" value="{{ old('attributes',$doc->attributes) }}">
                    @error('attributes') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                  </div>

                  {{-- Packaging --}}
                  <div class="col-lg-6 mb-2">
                    <h5>Packaging <span class="text-danger">*</span></h5>
                    <input type="text" name="packaging" class="form-control" value="{{ old('packaging', $doc->packaging) }}">
                    @error('packaging') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                  </div>

                  {{-- Grades --}}
                  <div class="col-lg-6 mb-2">
                    <h5>Grades <span class="text-danger">*</span></h5>
                    <input type="text" name="grades" class="form-control" value="{{ old('grades', $doc->grades) }}">
                    @error('grades') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                  </div>
                  {{-- Proof strength --}}
                  <div class="col-lg-6 mb-2">
                    <h5>Proof Strength <span class="text-danger">*</span></h5>
                    <input type="text" name="grades" class="form-control" value="{{ old('proof_strength', $doc->proof_strength) }}">
                    @error('proof_strength') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                  </div>
                  {{-- formula --}}
                  <div class="col-lg-6 mb-2">
                    <h5>Formula <span class="text-danger">*</span></h5>
                    <input type="text" name="formula" class="form-control" value="{{ old('formula', $doc->formula) }}">
                    @error('formula') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                  </div>

                  {{-- Certification --}}
                  <div class="col-lg-6 mb-2">
                    <h5>Certification <span class="text-danger">*</span></h5>
                    @if($doc->certification)
                      <img src="{{ asset('storage/' . $doc->certification) }}" width="100" class="mb-2">
                    @endif
                    <input type="file" name="certification" class="form-control" accept="image/*">
                    @error('certification') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                  </div>

                  {{-- Image --}}
                  <div class="col-lg-6 mb-2">
                    <h5>Image <span class="text-danger">*</span></h5>
                    @if($doc->image)
                      <img src="{{ asset('storage/' . $doc->image) }}" width="100" class="mb-2">
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @error('image') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                  </div>

                  {{-- Notes --}}
                  <div class="col-lg-12 mb-2">
                    <h5>Notes <span class="text-danger">*</span></h5>
                    <textarea name="notes" class="form-control">{{ old('notes', $doc->notes) }}</textarea>
                    @error('notes') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                  </div>

                  {{-- Supporting Documents --}}
                  <div class="col-lg-12 mb-2">
                    <h5>Supporting Documents <span class="text-danger">*</span></h5>
                    <div id="document-wrapper">
                      @foreach($doc->supportingDocuments as $index => $support)

  
                        <div class="document-group mb-2 row">
                           <input type="hidden" name="existing_documents[]" value="{{ $support->id }}">
                            <input type="hidden" name="supporting_documents[{{ $index }}][id]" value="{{ $support->id }}">
    

                          <div class="col-md-5">
                            <input type="text" name="supporting_documents[{{ $index }}][name]" class="form-control" value="{{ $support->name }}">
                          </div>
                          <div class="col-md-5">
                            @if($support->image)
                              <a href="{{ asset('storage/' . $support->image) }}" target="_blank">View Existing</a>
                            @endif
                            <input type="file" name="supporting_documents[{{ $index }}][file]" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                          </div>
                          <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-sm remove-doc">Remove</button>
                          </div>
                        </div>
                      @endforeach
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" id="add-document">Add Another Document</button>
                  </div>

                  <div class="col-lg-12 mt-3">
                    <button type="submit" class="btn btn-success">Update Documentation</button>
                  </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const wrapper = document.getElementById('document-wrapper');
  const addBtn = document.getElementById('add-document');
  let docIndex = {{ $doc->supportingDocuments->count() }};

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

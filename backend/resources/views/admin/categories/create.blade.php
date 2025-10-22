@extends('layouts.admin-app')

@section('content')
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
   <div class="container">
      <div class="page-header">
         <div class="page-title">
            <h3>Add Category</h3>
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

      <form method="post" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-lg-12 col-md-12 layout-spacing">
               <div class="statbox widget box box-shadow">
                 <div class="widget-header">
                     <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                           <h4>Add Category</h4>
                        </div>  
                         <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right mt-4">
                       <a href="{{url('admin/categories')}}" class="btn btn-primary btn-rounded"><i class="icon-pencil position-left"></i>All Categories</a>
                       
                    </div>                     
                     </div>
                    

                     <hr/>
                 </div>
                 <div class="widget-content widget-content-area">
                  <div class="row">
                    <div class="col-lg-6 mb-2">
                      <h5>Category Name</h5>
                      <input type="text" name="name" class="form-control" placeholder="Category Name" value="{{old('name')}}">
                      @if ($errors->has('name'))
                       <span class="invalid-feedback">
                         <strong>{{ $errors->first('name') }}</strong>
                       </span>
                     @endif
                    </div>
                     <div class="form-group col-md-6">
                        <label for="pwd">Parent Category:</label>
                        <select class="form-control select select-initialized" name="parent_id">
                           <option value="0">Select a category</option>
                           @if($categories)
                            
                           @foreach($categories as $category)
                             <?php $dash=''; ?>
                             <option value="{{$category->id}}" id="{{$category->parent_id}}" class="category-first">{{$category->name}}</option>
                             
                             @if(isset($category->subcategory) && count($category->subcategory))
                                 @include('admin.categories.subCategoryList-option',['subcategories' => $category->subcategory])
                             @endif
                            @endforeach

                           @endif
                        </select>
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


@endsection
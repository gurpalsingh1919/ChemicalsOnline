@extends('layouts.admin-app')

@section('content')
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
   <div class="container">
      <div class="page-header">
         <div class="page-title">
            <h3>General settings</h3>
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

      <form method="post" action="{{route('admin.create_settings_post')}}">
         @csrf
         <div class="row">
            <div class="col-lg-12 col-md-12 layout-spacing">
               <div class="statbox widget box box-shadow">
                 <div class="widget-header">
                     <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                           <h4>Create settings</h4>
                        </div>  
                         <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right mt-4">
                      <button type="submit" id="save" class="btn btn-success btn-rounded mr-4"><i class="icon-ok position-left"></i> Save</button>
                    </div>                     
                     </div>
                    

                     <hr/>
                 </div>
                 <div class="widget-content widget-content-area">
                  <div class="row">
                     <div class="col-lg-12 mb-5">
                        <h5>Name</h5>
                        <input type="text" name="name" class="form-control">
                        @if ($errors->has('name'))
                         <span class="invalid-feedback">
                           <strong>{{ $errors->first('name') }}</strong>
                         </span>
                       @endif
                     </div>
                  </div>
                     <div class="row">
                        <div class="col-lg-12 mb-5">
                           <h5>Value</h5>
                           <div class="panel-body">
                              <input type="text" name="value"  class="form-control" >
                             
                           </div>
                            @if ($errors->has('value'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('value') }}</strong>
                            </span>
                          @endif
                         </div>
                     </div>
                 </div>
               </div>
            </div>                    
         </div>
      </form>
   </div>
</div>


@endsection
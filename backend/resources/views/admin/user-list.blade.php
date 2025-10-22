@extends('layouts.admin-app')

@section('content')
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    <div class="page-header">
        <div class="page-title">
            <h3>Users</h3>
           
        </div>
    </div>
    
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
              <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>User Listing</h4>
              </div>                       
            </div>
          </div>
          <div class="widget-content widget-content-area">
            <div class="table-responsive">
              <table id="html5-extension" class="table table-bordered table-hover table-condensed mb-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Sign up date</th>
                        <th>Status</th>
                        <!-- <th class="align-center">Action</th> -->
                    </tr>
                </thead>

                <tbody>
                  @foreach($allusers as $index=>$userslist)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ucfirst($userslist->name)}}</td>
                        <td>{{$userslist->email}}</td>
                        <td>{{$userslist->phone}}</td>
                        <td>{{ Carbon\Carbon::parse($userslist->created_at)->format('Y-m-d') }}</td>
                       <td class="align-center">
                            @if($userslist->is_verified==1)
                                <span class="badge badge-primary">Verified</span>
                            @else
                                 <span class="badge badge-danger">Unverified</span>
                            @endif

                        </td>

                        <!-- <td class="text-center">
                            <ul class="table-controls">

                                
                               <li>
                                    @if($userslist->is_verified==1)
                                        <a href="{{url('admin/users/update/'.$userslist->id)}}" data-toggle="tooltip" data-placement="top" title="Make it Unverified">
                                            <i class="flaticon-close-fill text-danger fs-20"></i>
                                        </a>
                                     @else
                                        <a href="{{url('admin/users/update/'.$userslist->id)}}" data-toggle="tooltip" data-placement="top" title="Make it Verified">
                                            <i class="flaticon-fill-tick text-primary fs-20"></i>
                                        </a>
                                      @endif
                                </li>
                            </ul>
                        </td> -->
                    </tr>
                   @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>                    
    </div>
  </div>
</div>


@endsection
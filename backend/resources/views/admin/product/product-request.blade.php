@extends('layout.admin-app')

@section('content')
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
    <div class="container">
        <div class="page-header">
            <div class="page-title">
                <h3>Product Requests</h3>
               
            </div>
        </div>
        
        <div class="row">
            
        
            <div class="col-lg-12 col-md-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Product Requests Listing</h4>
                            </div>                       
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table id="html5-extension" class="table table-bordered table-hover table-condensed mb-4">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product name</th>
                                        <th>Request</th>
                                        <th>Name</th>
                                        <!-- <th>Zip Code</th> -->
                                        <th>Contact Info</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                       <!-- <th>Status</th>
                                         <th class="align-center">Action</th> -->
                                    </tr>
                                </thead>

                                <tbody>
                                     @foreach($productRequests as $index=>$product)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td><b>{{$product->product->name}}</b></td>
                                        <td>
                                            @if($product->type=='1')
                                                Request Sample
                                            @else
                                                Request Document
                                            @endif
                                        </td>
                                        <td>
                                            <b>Name:- </b>{{ucfirst($product->full_name)}} <br/>
                                            <b>Business Name:- </b> {{ucfirst($product->business_name)}}
                                        </td>
                                       <!-- <td>{{$product->zipcode}}</td> -->
                                        <td>
                                            <b>Email:- </b>{{$product->email}} <br/>
                                            <b>Phone:- </b>{{$product->phone_number}}
                                        </td>
                                       
                                       <td>{{$product->comment}}</td>
                                        <td>{{ Carbon\Carbon::parse($product->created_at)->isoFormat('Do, MMMM  YYYY') }}</td>
                                       <!--<td class="align-center">
                                            @if($product->status==1)
                                                <span class="badge badge-primary">Active</span>
                                            @else
                                                 <span class="badge badge-info">In-Active</span>
                                            @endif

                                        </td>

                                         <td class="text-center">
                                            <ul class="table-controls">

                                                
                                               <li>
                                                    @if($product->status==1)
                                                        <a href="{{url('admin/product-request/status/'.$product->id)}}" data-toggle="tooltip" data-placement="top" title="Mark as inactive">
                                                            <i class="flaticon-close-fill text-danger fs-20"></i>
                                                        </a>
                                                     @else
                                                        <a href="{{url('admin/product-request/status/'.$product->id)}}" data-toggle="tooltip" data-placement="top" title="Mark as active">
                                                            <i class="flaticon-close-fill text-info fs-20"></i>
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
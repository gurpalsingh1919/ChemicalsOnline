@extends('layouts.admin-app')

@section('content')

    <!-- BEGIN CONTENT PART -->
    <div id="content" class="main-content">
        <div class="container">

            <div class="page-header">
                <div class="page-title">
                    <h3>Add Event</h3>
                </div>
            </div>

            <!-- Flash Messages -->
            @if($errors->any())
                <div class="alert alert-danger">One or more fields have an error. Please check and try again.</div>
            @endif

            @if(session('error'))
                <div class="error alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Error :</strong> {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="error alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {!! session('success') !!}
                </div>
            @endif

            <form method="post" action="{{ route('admin.addevent_post') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-12 col-md-12 layout-spacing">
                        <div class="statbox widget box box-shadow">

                            <!-- Widget Header -->
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                        <h4>Create Event</h4>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right mt-4">
                                        <button type="submit" id="save" class="btn btn-success btn-rounded mr-4">
                                            <i class="icon-ok position-left"></i> Save
                                        </button>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- Widget Content -->
                            <div class="widget-content widget-content-area">

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <h5>Event Name</h5>
                                        <input type="text" name="event_name" class="form-control" placeholder="Enter event name">
                                        @if($errors->has('event_name'))
                                            <span class="invalid-feedback d-block">
                                                <strong>{{ $errors->first('event_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <h5>From Date</h5>
                                        <input type="date" name="from_date" class="form-control">
                                        @if($errors->has('from_date'))
                                            <span class="invalid-feedback d-block">
                                                <strong>{{ $errors->first('from_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <h5>To Date</h5>
                                        <input type="date" name="to_date" class="form-control">
                                        @if($errors->has('to_date'))
                                            <span class="invalid-feedback d-block">
                                                <strong>{{ $errors->first('to_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <h5>Location</h5>
                                        <input type="text" name="location" class="form-control"
                                            placeholder="Enter event location">
                                        @if($errors->has('location'))
                                            <span class="invalid-feedback d-block">
                                                <strong>{{ $errors->first('location') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <h5>Description</h5>
                                        <textarea name="description" rows="5" class="form-control" placeholder="Enter event description"></textarea>
                                        @if($errors->has('description'))
                                            <span class="invalid-feedback d-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            </div> <!-- end widget-content-area -->

                        </div> <!-- end statbox -->
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection
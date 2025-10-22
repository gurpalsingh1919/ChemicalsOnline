@extends('layouts.admin-app')

@section('content')

    <div id="content" class="main-content">
        <div class="container">

            <div class="page-header">
                <div class="page-title">
                    <h3>All Events</h3>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! session('success') !!}
                </div>
            @endif

            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                            <h4>Event List</h4>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                            <a href="{{ route('admin.add_event') }}" class="btn btn-primary btn-rounded mt-3 mr-4"><i
                                    class="flaticon-plus"></i> Add Event</a>
                        </div>
                    </div>
                    <hr />
                </div>

                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table id="html5-extension" class="table table-bordered table-hover table-condensed mb-4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Event Name</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Location</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($eventList as $index => $event)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ ucfirst($event->event_name) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($event->date_from)->format('Y-m-d') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($event->date_to)->format('Y-m-d') }}</td>
                                        <td>{{ $event->location }}</td>
                                        <td class="text-center">
                                            <ul class="table-controls">
                                                <li>
                                                    <a href="{{ route('admin.edit_event', $event->id) }}" data-toggle="tooltip"
                                                        title="Edit">
                                                        <i class="flaticon-edit text-primary fs-20"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" onclick="deleteEvent({{ $event->id }})"
                                                        data-toggle="tooltip" title="Delete">
                                                        <i class="flaticon-delete text-danger fs-20"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Events Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteEvent(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e7515a',
                cancelButtonColor: '#888',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/admin/event/delete/' + id;
                }
            });
        }
    </script>
@endsection
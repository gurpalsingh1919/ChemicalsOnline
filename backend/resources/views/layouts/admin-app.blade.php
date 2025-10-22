<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Pharmachemonline </title>
    <link rel="icon" href="{{ asset('img/UFC.png') }}" type="image/gif" sizes="16x16">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('admin/assets/css/support-chat.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/plugins/maps/vector/jvector/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ asset('admin/plugins/charts/chartist/chartist.css') }}" rel="stylesheet" type="text/css"> -->
    <link href="{{ asset('admin/assets/css/default-dashboard/style.css') }}" rel="stylesheet" type="text/css" />    
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('admin/assets/css/classic-dashboard/style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/bootstrap-select/bootstrap-select.min.css')}}">

    <!--  END CUSTOM STYLE FILE  -->   
     <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <style>        
        .table td, .table th { border-top: 1px solid #f1f3f1; }
        .table-controls>li>a i { color: #d3d3d3; }
        .category-first {
            font-size: 18px;
            font-weight: 600;
        }

        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-bottom: .5rem;
    font-weight: 600;
    line-height: 1.2;
    color: #000;
}
    </style>
    <!-- END PAGE LEVEL CUSTOM STYLES -->
      <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('admin/plugins/editors/summernote/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/plugins/editors/summernote/custom-summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/table/datatable/custom_dt_html5.css') }}">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    <style>
            label {
                display: inline-block;
                margin-bottom: .5rem;
                font-weight: 600;
                /* font-size: 16px; */
                color: #000;
            }
            .form-control {
            border-radius: 8px;
            border: 1px solid #515365;
        }
    </style>
</head>
<body class="default-sidebar">

    <!-- Tab Mobile View Header -->
    <header class="tabMobileView header navbar fixed-top d-lg-none">
        <div class="nav-toggle">
                <a href="javascript:void(0);" class="nav-link sidebarCollapse" data-placement="bottom">
                    <i class="flaticon-menu-line-2"></i>
                </a>
            <a href="/" class=""> <img src="{{asset('img/UFC_Website_Logo_07.jpg')}}" class="img-fluid" alt="logo"></a>
        </div>
        <ul class="nav navbar-nav">
            <li class="nav-item d-lg-none"> 
                <form class="form-inline justify-content-end" role="search">
                    <input type="text" class="form-control search-form-control mr-3">
                </form>
            </li>
        </ul>
    </header>
    <!-- Tab Mobile View Header -->

    <!--  BEGIN NAVBAR  -->
    <header class="header navbar fixed-top navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse d-none d-lg-block" data-placement="bottom"><i class="flaticon-menu-line-2"></i></a>
        


       


        <ul class="navbar-nav flex-row ml-lg-auto">
            
            <li class="nav-item  d-lg-block d-none">
                <form class="form-inline" role="search">
                    <input type="text" class="form-control search-form-control" placeholder="Search...">
                </form>
            </li>

           
            <li class="nav-item dropdown user-profile-dropdown ml-lg-0 mr-lg-2 ml-3 order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="flaticon-user-12"></span>
                </a>
                <div class="dropdown-menu  position-absolute" aria-labelledby="userProfileDropdown">
                   <!--  <a class="dropdown-item" href="user_profile.html">
                        <i class="mr-1 flaticon-user-6"></i> <span>My Profile</span>
                    </a>
                    <a class="dropdown-item" href="apps_scheduler.html">
                        <i class="mr-1 flaticon-calendar-bold"></i> <span>My Schedule</span>
                    </a>
                    <a class="dropdown-item" href="apps_mailbox.html">
                        <i class="mr-1 flaticon-email-fill-1"></i> <span>My Inbox</span>
                    </a>
                    <a class="dropdown-item" href="user_lockscreen_1.html">
                        <i class="mr-1 flaticon-lock-2"></i> <span>Lock Screen</span>
                    </a> -->
                    <div class="dropdown-divider"></div>
                   
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">
                    <i class="mr-1 flaticon-power-button"></i> <span>{{ __('Logout') }}</span>
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </div>
            </li>

            <!-- <li class="nav-item dropdown cs-toggle order-lg-0 order-3"> 
                <a href="#" class="nav-link toggle-control-sidebar suffle">
                    <span class="flaticon-menu-dot-fill d-lg-inline-block d-none"></span>
                    <span class="flaticon-dots d-lg-none"></span>
                </a>
            </li> -->
        </ul>
    </header>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
          @include('admin.left-sidebar')

        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT PART  -->
       
        @yield('content')
       
        
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    

    <!--  BEGIN FOOTER  -->
    <footer class="footer-section theme-footer">

        <div class="footer-section-1  sidebar-theme">
            
        </div>

        <div class="footer-section-2 container-fluid">
            <div class="row">
                <div id="toggle-grid" class="col-xl-7 col-md-6 col-sm-6 col-12 text-sm-left text-center">
                    <!-- <ul class="list-inline links ml-sm-5">
                        <li class="list-inline-item mr-3">
                            <a href="javascript:void(0);">Home</a>
                        </li>
                        <li class="list-inline-item mr-3">
                            <a href="javascript:void(0);">Blog</a>
                        </li>
                        <li class="list-inline-item mr-3">
                            <a href="javascript:void(0);">About</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript:void(0);">Buy</a>
                        </li>
                    </ul> -->
                </div>
                <div class="col-xl-5 col-md-6 col-sm-6 col-12">
                    <ul class="list-inline mb-0 d-flex justify-content-sm-end justify-content-center mr-sm-3 ml-sm-0 mx-3">
                        <li class="list-inline-item  mr-3">
                            <p class="bottom-footer">&#xA9; 2025 <a target="_blank" href="{{url('/')}}">All Rights Reserved. Global Chemicals Corporation</a></p>
                        </li>
                        <li class="list-inline-item align-self-center">
                            <div class="scrollTop"><i class="flaticon-up-arrow-fill-1"></i></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--  END FOOTER  -->

   

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('admin/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('admin/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <!-- <script src="{{ asset('admin/plugins/charts/chartist/chartist.js') }}"></script> -->
    <script src="{{ asset('admin/plugins/maps/vector/jvector/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/maps/vector/jvector/worldmap_script/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin/plugins/calendar/pignose/moment.latest.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/calendar/pignose/pignose.calendar.js') }}"></script>
    <!-- <script src="{{ asset('admin/plugins/progressbar/progressbar.min.js') }}"></script> -->
    <script src="{{ asset('admin/assets/js/default-dashboard/default-custom.js') }}"></script>
    
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
     <script>
        checkall('todoAll', 'todochkbox');
        $('[data-toggle="tooltip"]').tooltip()
    </script>

     <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('admin/plugins/editors/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/editors/summernote/editor_summernote.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->  
     <script src="{{ asset('admin/assets/js/classic-dashboard/classic-custom.js') }}"></script> 

      <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="{{ asset('admin/plugins/table/datatable/datatables.js') }}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{ asset('admin/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>    
    <script src="{{ asset('admin/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('admin/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        $('#html5-extension').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn btn-default btn-rounded btn-sm mb-4' },
                    { extend: 'csv', className: 'btn btn-default btn-rounded btn-sm mb-4' },
                    { extend: 'excel', className: 'btn btn-default btn-rounded btn-sm mb-4' },
                    { extend: 'print', className: 'btn btn-default btn-rounded btn-sm mb-4' }
                ]
            },
            "language": {
                "paginate": {
                  "previous": "<i class='flaticon-arrow-left-1'></i>",
                  "next": "<i class='flaticon-arrow-right'></i>"
                },
                "info": "Showing page _PAGE_ of _PAGES_"
            }
        } );
    </script>
    <script>
        $('#zero-config').DataTable({
            "language": {
                "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
                "info": "Showing page _PAGE_ of _PAGES_"
            }
        });
    </script>
    
</body>
</html>
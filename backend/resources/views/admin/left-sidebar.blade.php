<div class="sidebar-wrapper sidebar-theme">
    <div id="dismiss" class="d-lg-none"><i class="flaticon-cancel-12"></i></div>
    <nav id="sidebar">

        <ul class="navbar-nav theme-brand flex-row  d-none d-lg-flex">
            <li class="nav-item d-flex">
                <a href="{{route('admin.dashboard')}}" class="navbar-brand">
                    <img src="{{asset('img/logo-new-GG_540x.png')}}" class="img-fluid" alt="logo">
                </a>

            </li>
            <!-- <li class="nav-item theme-text">
                <a href="index.html" class="nav-link"> Equation </a>
            </li> -->
        </ul>


        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="{{route('admin.dashboard')}}" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <i class="flaticon-computer-6 ml-3"></i>
                        <span>Dashboard</span>
                    </div>

                    <div>
                        <span class="badge badge-pill badge-secondary mr-2">5</span>
                    </div>
                </a>

            </li>
            <li class="menu">
                <a href="#products" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="flaticon-sun"></i>
                        <span>Products </span>
                    </div>
                    <div>
                        <i class="flaticon-right-arrow"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="products" data-parent="#accordionExample">
                    <!-- <li>
                        <a href="{{route('admin.add_product')}}"> Add Product</a>
                    </li> -->
                    <li>
                        <a href="{{route('admin.all_products')}}"> All Products </a>
                    </li>

                    <li>
                        <a href="{{route('admin.import_form')}}">Import Products</a>
                    </li>

                </ul>
            </li>
            <li class="menu">
                <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div><i class="flaticon-user-circle"></i><span>Users</span></div>
                    <div><i class="flaticon-right-arrow"></i></div>
                </a>
                <ul class="collapse submenu list-unstyled" id="users" data-parent="#accordionExample">
                    <li><a href="{{ route('admin.all_users') }}">All Users</a></li>
                </ul>
            </li>
            <li class="menu">
                <a href="#categories" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="flaticon-sun"></i>
                        <span>Categories </span>
                    </div>
                    <div>
                        <i class="flaticon-right-arrow"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="categories" data-parent="#accordionExample">
                    <li>
                        <a href="{{route('admin.categories.create')}}"> Add Category</a>
                    </li>
                    <li>
                        <a href="{{url('admin/categories')}}"> All Categories </a>
                    </li>

                    <!-- <li>
                        <a href="#"> Inactive </a>
                    </li> -->

                </ul>
            </li>
            <li class="menu">
                <a href="#docs" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="flaticon-sun"></i>
                        <span>Product Documentation </span>
                    </div>
                    <div>
                        <i class="flaticon-right-arrow"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="docs" data-parent="#accordionExample">
                    <li>
                        <a href="{{route('admin.docs.create')}}"> Add docs</a>
                    </li>
                    <li>
                        <a href="{{url('admin/docs')}}"> All docs </a>
                    </li>

                    <!-- <li>
                        <a href="#"> Inactive </a>
                    </li> -->

                </ul>
            </li>
            <li class="menu">
                <a href="#contact-requests" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div><i class="flaticon-mail-10"></i><span>Contact Requests</span></div>
                    <div><i class="flaticon-right-arrow"></i></div>
                </a>
                <ul class="collapse submenu list-unstyled" id="contact-requests" data-parent="#accordionExample">
                    <li><a href="{{route('admin.all_contactrequests')}}">All Requests</a></li>
                </ul>
            </li>

            <li class="menu">
                <a href="#general-settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div><i class="flaticon-settings-1"></i><span>General Settings</span></div>
                    <div><i class="flaticon-right-arrow"></i></div>
                </a>
                <ul class="collapse submenu list-unstyled" id="general-settings" data-parent="#accordionExample">
                    <li><a href="{{url('admin/general-settings')}}">Settings</a></li>
                    <li><a href="{{route('admin.create_settings')}}">Add New</a></li>
                </ul>
            </li>


        </ul>
    </nav>
</div>
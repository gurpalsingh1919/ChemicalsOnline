<div class="top-bar">
<!-- Left Side Of Navbar -->
<style>
    
    .top-bar {
        background-color: #1533b7;
    }
    .top-bar ul {
        display: inline-block;
        margin: 0px;
        width: 100%;
        text-align: right;
        padding-right: 20px;
    }
    .top-bar .nav-item {
        display: inline-block;
        list-style-type: none;
    }
    .top-bar .nav-item a {
        color: #fff;
        padding: 5px 10px;
        font-size: 14px;
    }
</style>

<!-- Right Side Of Navbar -->
<ul class="ml-auto">
    <!-- Authentication Links -->
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Sign In') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Sign out') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
        </li>
    @endguest
</ul>
</div>
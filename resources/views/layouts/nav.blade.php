<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
           target="_blank">
            <img src="{{asset('assets/img/logo-ct.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Dashboard </span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white  bg-gradient-" href="{{route("home")}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Orders</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white bg-gradient-" href="{{route("orders.index","not_delivered")}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">money</i>
                    </div>
                    <span class="nav-link-text ms-1 mr-3">not deliverd orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white bg-gradient-" href="{{route("orders.index","pending_delivery")}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">money</i>
                    </div>
                    <span class="nav-link-text ms-1 mr-3">pending orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white bg-gradient-" href="{{route("orders.index","delivered")}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">money</i>
                    </div>
                    <span class="nav-link-text ms-1 mr-3">delivered orders</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">trucks</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white bg-gradient-" href="{{route("trucks.index")}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">directions_car</i>
                    </div>
                    <span class="nav-link-text ms-1 mr-3">trucks</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white bg-gradient-" href="{{route("trucks.create")}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">add</i>
                    </div>
                    <span class="nav-link-text ms-1 mr-3">add</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Drivers</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white bg-gradient-" href="{{route("users.index")}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">people</i>
                    </div>
                    <span class="nav-link-text ms-1 mr-3">drivers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white bg-gradient-" href="{{route("users.create")}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">add</i>
                    </div>
                    <span class="nav-link-text ms-1 mr-3">add</span>
                </a>
            </li>
            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link text-white " href="">--}}
            {{--                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">--}}
            {{--                        <i class="material-icons opacity-10">table_view</i>--}}
            {{--                    </div>--}}
            {{--                    <span class="nav-link-text ms-1">Tables</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link text-white " href="../pages/billing.html">--}}
            {{--                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">--}}
            {{--                        <i class="material-icons opacity-10">receipt_long</i>--}}
            {{--                    </div>--}}
            {{--                    <span class="nav-link-text ms-1">Billing</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link text-white " href="../pages/virtual-reality.html">--}}
            {{--                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">--}}
            {{--                        <i class="material-icons opacity-10">view_in_ar</i>--}}
            {{--                    </div>--}}
            {{--                    <span class="nav-link-text ms-1">Virtual Reality</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link text-white " href="../pages/rtl.html">--}}
            {{--                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">--}}
            {{--                        <i class="material-icons opacity-10">format_textdirection_r_to_l</i>--}}
            {{--                    </div>--}}
            {{--                    <span class="nav-link-text ms-1">RTL</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link text-white " href="../pages/notifications.html">--}}
            {{--                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">--}}
            {{--                        <i class="material-icons opacity-10">notifications</i>--}}
            {{--                    </div>--}}
            {{--                    <span class="nav-link-text ms-1">Notifications</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item mt-3">--}}
            {{--                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link text-white " href="../pages/profile.html">--}}
            {{--                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">--}}
            {{--                        <i class="material-icons opacity-10">person</i>--}}
            {{--                    </div>--}}
            {{--                    <span class="nav-link-text ms-1">Profile</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link text-white " href="../pages/sign-in.html">--}}
            {{--                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">--}}
            {{--                        <i class="material-icons opacity-10">login</i>--}}
            {{--                    </div>--}}
            {{--                    <span class="nav-link-text ms-1">Sign In</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">profile</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</aside>

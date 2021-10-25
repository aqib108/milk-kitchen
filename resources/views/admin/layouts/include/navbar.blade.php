<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        @if (Auth::user()->hasRole('Driver'))
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" id="messageDropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge" id="notificationCount">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header" id="notificationCount"> Notifications</span>
                    <div class="dropdown-divider"></div>
                    <div id="notifications">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> No Message
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
        @endif
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img
                    src="{{asset('admin-panel/images/admin-placeholder.png')}}"
                class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">
                  {{auth()->user()->name}}
                </span>
            </a>
            <ul class="dropdown-menu w-25 ">
                <!-- Menu Footer-->
                <li>
                    <a href="{{route('admin.setting')}}" class="btn btn-dark btn-flat w-100">Update Password</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="btn btn-dark btn-flat w-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </li>
    </ul>
</nav>
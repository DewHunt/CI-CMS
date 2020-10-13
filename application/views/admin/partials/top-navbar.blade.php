@php    
    use Illuminate\Support\Facades\URL;
    $userId =  Auth::user()->id;
@endphp


            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                    <!-- Logo -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('/admin') }}">
                            <!-- Logo icon -->
                            <b>
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Small Logo icon -->
                                <img src="{{ asset('public/elite-admin/assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />

                                <!-- Light Small Logo icon -->
                                <img src="{{ asset('public/elite-admin/assets/images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->

                            <!-- Logo text -->
                            <span>
                                <!-- Dark Large Logo text -->
                                <img src="{{ asset('public/elite-admin/assets/images/logo-text.png') }}" alt="homepage" class="dark-logo" />

                                <!-- Light Large Logo text -->    
                                <img src="{{ asset('public/elite-admin/assets/images/logo-light-text.png') }}" class="light-logo" alt="homepage" />
                            </span>
                         </a>
                    </div>
                    <!-- End Logo -->

                    <div class="navbar-collapse">
                        <!-- toggle and nav items -->
                        <ul class="navbar-nav mr-auto">
                            <!-- This is  -->
                            <li class="nav-item">
                                <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)">
                                    <i class="ti-menu"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>

                        <!-- User profile and search -->
                        <ul class="navbar-nav my-lg-0">
                            <!-- User Profile -->
                            <li class="nav-item dropdown u-pro">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('public/elite-admin/assets/images/users/1.jpg') }}" alt="user" class="">
                                    <span class="hidden-md-down">
                                        {{ Auth::user()? Auth::user()->name:"Admin" }} &nbsp;<i class="fa fa-angle-down"></i>
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                    <!-- text-->
                                    <a href="{{ route('user.myProfile',[$userId,1]) }}" class="dropdown-item">
                                        <i class="ti-user"></i> My Profile
                                    </a>

                                    <!-- text-->
                                    <a href="{{ route('user.changePassword',[$userId,1]) }}" class="dropdown-item">
                                        <i class="ti-wallet"></i> Change Password
                                    </a>

                                    <!-- text-->
                                    <div class="dropdown-divider"></div>

                                    <!-- text-->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>

                                    <a href="{{ Auth::guard('admin')->check() ? route('admin.logout') : (Auth::guard('web')->check() ? route('user.logout') : (Auth::guard('customer')->check() ? route('customer.logout') : route('logout'))) }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                                        <i class="fa fa-power-off"></i> Logout
                                    </a>
                                    <!-- text-->
                                </div>
                            </li>
                            <!-- End User Profile -->
                            
                            <li class="nav-item right-side-toggle">
                                <a class="nav-link  waves-effect waves-light" href="javascript:void(0)">
                                    <i class="ti-settings"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
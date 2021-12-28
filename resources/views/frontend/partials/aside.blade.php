
<div class="menu-area menu-sticky">
    <div class="container custom">
        <div class="row-table">
            <div class="col-cell header-logo">                                  
                <div class="logo-area">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logo_richboss.png') }}" alt="{{ env('APP_NAME') }}">  
                    </a>
                </div>
            </div>
            <div class="col-cell">
                <div class="rs-menu-area">
                    <div class="main-menu">
                        <nav class="rs-menu hidden-md">
                            <ul class="nav-menu">
                                <li>
                                    <a href="{{ route('frontend.clients.payments') }}">Payments</a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.clients.properties') }}">Property</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">My Account</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('frontend.clients.profile') }}">My Profile</a></li>
                                        <li>                
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }}</form>
                                        </li>
                                    </ul>
                                </li>
                            </ul> <!-- //.nav-menu -->
                        </nav>
                    </div> <!-- //.main-menu -->
                </div>
            </div>
            <div class="col-cell">
                <div class="expand-btn-inner">
                    <ul>
                        <li class="search-parent">
                            <a class="hidden-xs rs-search" data-bs-toggle="modal" data-bs-target="#searchModal" href="#">
                                <i class="flaticon-search"></i>
                            </a>
                        </li>
                        <li class="humburger">
                            <a id="nav-expander" class="nav-expander bar" href="#">
                                <div class="bar">
                                    <span class="dot1"></span>
                                    <span class="dot2"></span>
                                    <span class="dot3"></span>
                                    <span class="dot4"></span>
                                    <span class="dot5"></span>
                                    <span class="dot6"></span>
                                    <span class="dot7"></span>
                                    <span class="dot8"></span>
                                    <span class="dot9"></span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
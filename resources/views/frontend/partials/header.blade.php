
<header id="rs-header" class="rs-header style2 header-transparent">

    <!-- Menu Start -->
    @include('frontend.partials.aside')
    <!-- Menu End -->
    
    <!-- Canvas Mobile Menu start -->
    <nav class="right_menu_togle mobile-navbar-menu" id="mobile-navbar-menu">
        <div class="close-btn">
            <a id="nav-close2" class="nav-close">
                <div class="line">
                    <span class="line1"></span>
                    <span class="line2"></span>
                </div>
            </a>
        </div>
        <ul class="nav-menu">
            <li>
                <a href="{{ route('frontend.dashboard') }}">Dashboard</a>
            </li>
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
                </ul>
            </li>
        </ul> <!-- //.nav-menu -->
        <div class="canvas-contact">
                <div class="address-area">
                    <div class="address-list">
                        <div class="info-icon">
                            <i class="flaticon-location"></i>
                        </div>
                        <div class="info-content">
                            <h4 class="title">Address</h4>
                            <em>05 kandi BR. New York</em>
                        </div>
                    </div>
                    <div class="address-list">
                        <div class="info-icon">
                            <i class="flaticon-email"></i>
                        </div>
                        <div class="info-content">
                            <h4 class="title">Email</h4>
                            <em><a href="mailto:support@rstheme.com">support@rstheme.com</a></em>
                        </div>
                    </div>
                    <div class="address-list">
                        <div class="info-icon">
                            <i class="flaticon-call"></i>
                        </div>
                        <div class="info-content">
                            <h4 class="title">Phone</h4>
                            <em>+019988772</em>
                        </div>
                    </div>
                </div>
        </div>
    </nav>
    <!-- Canvas Menu end -->
</header>
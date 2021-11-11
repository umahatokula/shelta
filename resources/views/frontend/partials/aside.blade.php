
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark fw-medium font-size-16">Patrick Becker</a>
                <p class="text-body mt-1 mb-0 font-size-13">UI/UX Designer</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('frontend.dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('frontend.clients.payments', auth()->user()->client) }}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Payments</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('frontend.clients.properties', auth()->user()->client) }}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>My Property</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Account</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="{{ route('frontend.clients.profile', auth()->user()->client) }}" class="waves-effect">Profile</a>
                        </li>
                    </ul>

                </li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a class="waves-effect" href="route('logout')" onclick="event.preventDefault();  this.closest('form').submit();">
                            <i class="mdi mdi-calendar-text"></i> {{ __('Log Out') }}
                        </a>
                    </form>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<div class="app-sidebar">
    <div class="logo">
        <a href="{{ url('/') }}" class="logo-icon"><span class="logo-text">&nbsp</span></a>
    </div>
    <div class="app-menu">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Dashboard
            </li>

            <li class="{{ url()->current() == route('dashboard') ? 'active-page' : '' }}">
                <a href="{{route('dashboard')}}" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
            </li>

            <li class="{{ (url()->current() == route('clients.index') ? 'active-page' : '') || (url()->current() == route('clients.create') ? 'active-page' : '') }}">
                <a href=""><i class="material-icons-two-tone">people</i>Clients<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li class="{{ url()->current() == route('clients.index') ? 'active' : '' }}">
                        <a href="{{ route('clients.index') }}" class="item">All Clients</a>
                    </li>
                    <li class="{{ url()->current() == route('clients.create') ? 'active' : '' }}">
                        <a href="{{ route('clients.create') }}" class="item">Add Client</a>
                    </li>
                </ul>
            </li>

            <li class="{{ (url()->current() == route('properties.index') ? 'active-page' : '') || (url()->current() == route('properties.create') ? 'active-page' : '') }}">
                <a href=""><i class="material-icons-two-tone">other_houses</i>Properties<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li class="{{ url()->current() == route('properties.index') ? 'active' : '' }}">
                        <a href="{{ route('properties.index') }}" class="item">All Properties</a>
                    </li>
                    <li class="{{ url()->current() == route('properties.create') ? 'active' : '' }}">
                        <a href="{{ route('properties.create') }}" class="item">Add Property</a>
                    </li>
                </ul>
            </li>

            <li class="{{ (url()->current() == route('estates.index') ? 'active-page' : '') || (url()->current() == route('estates.create') ? 'active-page' : '') }}">
                <a href=""><i class="material-icons-two-tone">home_work</i>Estates<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li class="{{ url()->current() == route('estates.index') ? 'active' : '' }}">
                        <a href="{{ route('estates.index') }}" class="item">All Estates</a>
                    </li>
                    <li class="{{ url()->current() == route('estates.create') ? 'active' : '' }}">
                        <a href="{{ route('estates.create') }}" class="item">Add Estate</a>
                    </li>
                </ul>
            </li>

            <li class="{{ (url()->current() == route('property-types.index') ? 'active-page' : '') || (url()->current() == route('property-types.create') ? 'active-page' : '') }}">
                <a href=""><i class="material-icons-two-tone">holiday_village</i>Property
                            Types<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li class="{{ url()->current() == route('property-types.index') ? 'active' : '' }}">
                        <a href="{{ route('property-types.index') }}" class="item">All Property
                            Types</a>
                    </li>
                    <li class="{{ url()->current() == route('property-types.create') ? 'active' : '' }}">
                        <a href="{{ route('property-types.create') }}" class="item">Add Property
                            Type</a>
                    </li>
                </ul>
            </li>

            <li class="{{ (url()->current() == route('payment-plans.index') ? 'active-page' : '') || (url()->current() == route('payment-plans.create') ? 'active-page' : '') }}">
                <a href=""><i class="material-icons-two-tone">paid</i>Payment Plans<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li class="{{ url()->current() == route('payment-plans.index') ? 'active' : '' }}">
                        <a href="{{ route('payment-plans.index') }}" class="item">All Payment Plans</a>
                    </li>
                    <li class="{{ url()->current() == route('payment-plans.create') ? 'active' : '' }}">
                        <a href="{{ route('payment-plans.create') }}" class="item">Add Payment Plans</a>
                    </li>
                </ul>
            </li>

            <li class="{{ (url()->current() == route('property-prices.index') ? 'active-page' : '') || (url()->current() == route('property-prices.create') ? 'active-page' : '') }}">
                <a href=""><i class="material-icons-two-tone">paid</i>Property Prices<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li class="{{ url()->current() == route('payment-plans.index') ? 'active' : '' }}">
                        <a href="{{ route('property-prices.index') }}" class="item">All Property Prices</a>
                    </li>
                    <li class="{{ url()->current() == route('payment-plans.create') ? 'active' : '' }}">
                        <a href="{{ route('property-prices.create') }}" class="item">Add Property Price</a>
                    </li>
                </ul>
            </li>

            <li class="{{ (url()->current() == route('staff.index') ? 'active-page' : '') || (url()->current() == route('staff.create') ? 'active-page' : '') }}">
                <a href=""><i class="material-icons-two-tone">supervisor_account</i>Staff<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li class="{{ url()->current() == route('staff.index') ? 'active' : '' }}">
                        <a href="{{ route('staff.index') }}" class="item">All Staff</a>
                    </li>
                    <li class="{{ url()->current() == route('staff.create') ? 'active' : '' }}">
                        <a href="{{ route('staff.create') }}" class="item">Add Staff</a>
                    </li>
                </ul>
            </li>

            <li class="{{ url()->current() == route('transactions.index') ? 'active-page' : '' }}">
                <a href="{{route('transactions.index')}}" class="active"><i class="material-icons-two-tone">receipt_long</i>Transactions</a>
            </li>

            <li class="sidebar-title">
                Settings
            </li>

            <li class="{{ (url()->current() == route('staff.profile') ? 'active-page' : '') || (url()->current() == route('users.index') ? 'active-page' : '') || (url()->current() == route('settings.index') ? 'active-page' : '') }}">
                <a href=""><i class="material-icons-two-tone">settings</i>Settings<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li class="{{ url()->current() == route('staff.profile') ? 'active' : '' }}">
                        <a href="{{ route('staff.profile') }}" class="item">My Profile</a>
                    </li>
                    <li class="{{ url()->current() == route('users.index') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}" class="item">Users</a>
                    </li>
                    <li class="{{ url()->current() == route('settings.index') ? 'active' : '' }}">
                        <a href="{{ route('settings.payment-reminders') }}" class="item">Payment Reminders</a>
                    </li>
                    <li class="{{ url()->current() == route('settings.index') ? 'active' : '' }}">
                        <a href="{{ route('imports.clients') }}" class="item">Imports</a>
                    </li>
                    <li class="{{ url()->current() == route('settings.index') ? 'active' : '' }}">
                        <a href="{{ route('settings.index') }}" class="item">Company Profile</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-icons-two-tone">logout</i>Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }}</form>
            </li>
        </ul>
    </div>
</div>

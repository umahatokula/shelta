<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Dashboard</li>
                    <li class="">
                        <a href="{{ route('dashboard') }}">
                            <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="header">Admin</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Clients
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('clients.index') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>All Clients</a></li>
                            <li><a href="{{ route('clients.create') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Add Client</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Estates
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('estates.index') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>All Estates</a></li>
                            <li><a href="{{ route('estates.create') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Add Estate</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Property
                            Types
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('property-types.index') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>All Property Types</a>
                            </li>
                            <li><a href="{{ route('property-types.create') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Add Property Types</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Payment Plans
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('payment-plans.index') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>All Payment Plans</a>
                            </li>
                            <li><a href="{{ route('payment-plans.create') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Add Payment Plans</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Staff
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('staff.index') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>All Staff</a></li>
                            <li><a href="{{ route('staff.create') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Add Staff</a></li>
                        </ul>
                    </li>
                    <li><a href="ui_badges.html"><i class="icon-Commit"><span class="path1"></span><span
                                    class="path2"></span></i>Badges</a></li>
					
					<li class="header">Settings</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Write"><span class="path1"></span><span class="path2"></span></i>
                            <span>Settings</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
							<li><a href="{{ route('users.index') }}"><i class="icon-Commit"><span class="path1"></span><span
											class="path2"></span></i>Users</a></li>
							<li><a href="{{ route('settings.index') }}"><i class="icon-Commit"><span class="path1"></span><span
											class="path2"></span></i>Company Profile</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</aside>

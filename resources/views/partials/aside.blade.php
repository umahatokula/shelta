<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="d-flex align-items-center logo-box justify-content-start d-md-block d-none">
            <!-- Logo -->
            <a href="#" class="logo">
                <!-- logo-->
                <div class="logo-mini" style="width: 150px">
                    <span class="light-logo"><img src="{{ asset('assets/images/logo.jpg') }}" alt="logo"></span>
                </div>
            </a>
        </div>
        <div class="user-profile my-15 px-20 py-10 b-1 rounded10 mx-15">
            <div class="d-flex align-items-center justify-content-between">
                <div class="image d-flex align-items-center">
                    <img src="/assets/images/avatar/avatar-13.png" class="rounded-0 me-10" alt="User Image">
                    <div>
                        <h4 class="mb-0 fw-600">Nil Yeager</h4>
                        <p class="mb-0">Super Admin</p>
                    </div>
                </div>
                <div class="info">
                    <a class="dropdown-toggle p-15 d-grid" data-bs-toggle="dropdown" href="#"></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="{{route('profile.show')}}" class="dropdown-item">
                           <i class="ti-user"></i> Profile
                        </a>
                        <a @click.prevent="logout" class="dropdown-item" href="#"><i class="ti-lock"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="multinav">
            <div class="multinav-scroll" style="height: 97%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Main Menu</li>
                    <li>
                        <a href="route('profile.show')">
                            <i class="icon-Layout-4-blocks"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></i>
                            <span>Clients</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('clients.index') }}">
                                    <i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>All Clients
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('clients.create') }}">
                                    <i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Add Client
                                </a>
                            </li>	
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                            <span>Settings</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Card
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="{{ route('profile.show') }}">
                                            <i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>User
                                            Card
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile.show') }}">
                                            <i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Advanced
                                            Card
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>BS UI
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="{{ route('profile.show') }}">
                                            <i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Grid
                                            System
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile.show') }}">
                                            <i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Badges
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</aside>
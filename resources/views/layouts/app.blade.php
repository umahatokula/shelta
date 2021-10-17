
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>


    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('assets/src/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('assets/src/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/css/skin_color.css') }}">

</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">
    
    <div class="wrapper">
        <div id="loader"></div>

        <header class="main-header">
            <div class="d-flex align-items-center logo-box justify-content-start d-md-none d-block">
                <!-- Logo -->
                <a class="logo">
                    <!-- logo-->
                    <div class="logo-mini w-30">
                        <span class="light-logo"><img src="{{ asset('assets/images/logo.jpg') }}" alt="logo"></span>
                        <span class="dark-logo"><img src="{{ asset('assets/images/logo.jpg') }}" alt="logo"></span>
                    </div>
                    <div class="logo-lg">
                        <span class="light-logo"><img src="{{ asset('assets/images/logo.jpg') }}" alt="logo"></span>
                        <span class="dark-logo"><img src="{{ asset('assets/images/logo.jpg') }}" alt="logo"></span>
                    </div>
                </a>
            </div>
            <!-- Header Navbar -->
            @include('partials.nav')
        </header>

        @include('partials.aside')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">
                <!-- Main content -->
                {{ $slot }}
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->

        @include('partials.footer')
        <!-- Side panel -->
        <!-- quick_panel_toggle -->
        <div class="modal modal-right fade" id="quick_panel_toggle" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content slim-scroll2">
                    <div class="modal-body bg-white py-20 px-0">
                        <div class="d-flex align-items-center justify-content-between pb-30">
                            <ul class="nav nav-tabs customtab3 px-30" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab"
                                        href="#quick_panel_notifications">Notifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#quick_panel_logs">Logs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#quick_panel_settings">Settings</a>
                                </li>
                            </ul>
                            <div class="offcanvas-close">
                                <a href="#" class="btn btn-icon btn-danger-light btn-sm no-shadow"
                                    data-bs-dismiss="modal">
                                    <span class="fa fa-close"></span>
                                </a>
                            </div>
                        </div>
                        <div class="px-30">
                            <div class="tab-content">
                                <div class="tab-pane active" id="quick_panel_notifications" role="tabpanel">
                                    <div>
                                        <div class="media-list">
                                            <div class="media media-single px-0">
                                                <h4 class="w-50 text-gray fw-500">10:10</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-primary">
                                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                                    <span class="text-fade">by Johne</span>
                                                </div>
                                            </div>

                                            <div class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">08:40</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-success">
                                                    <p>Proin iaculis eros non odio ornare efficitur.</p>
                                                    <span class="text-fade">by Amla</span>
                                                </div>
                                            </div>

                                            <div class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">07:10</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-info">
                                                    <p>In mattis mi ut posuere consectetur.</p>
                                                    <span class="text-fade">by Josef</span>
                                                </div>
                                            </div>

                                            <div class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">01:15</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-danger">
                                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                                    <span class="text-fade">by Rima</span>
                                                </div>
                                            </div>

                                            <div class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">23:12</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-warning">
                                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                                    <span class="text-fade">by Alaxa</span>
                                                </div>
                                            </div>
                                            <div class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">10:10</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-primary">
                                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                                    <span class="text-fade">by Johne</span>
                                                </div>
                                            </div>

                                            <div class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">08:40</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-success">
                                                    <p>Proin iaculis eros non odio ornare efficitur.</p>
                                                    <span class="text-fade">by Amla</span>
                                                </div>
                                            </div>

                                            <div class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">07:10</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-info">
                                                    <p>In mattis mi ut posuere consectetur.</p>
                                                    <span class="text-fade">by Josef</span>
                                                </div>
                                            </div>

                                            <div class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">01:15</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-danger">
                                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                                    <span class="text-fade">by Rima</span>
                                                </div>
                                            </div>

                                            <div class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">23:12</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-warning">
                                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                                    <span class="text-fade">by Alaxa</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="quick_panel_logs" role="tabpanel">
                                    <div class="mb-30">
                                        <h5 class="fw-500 mb-15">Tasks Overview</h5>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-primary-light h-50 w-50 l-h-60 rounded text-center">
                                                <span class="icon-Library fs-24"><span class="path1"></span><span
                                                        class="path2"></span></span>
                                            </div>
                                            <div class="d-flex flex-column fw-500">
                                                <a href="projects.html"
                                                    class="text-dark hover-primary mb-1 fs-16">Project Briefing</a>
                                                <span class="text-fade">Project Manager</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-danger-light h-50 w-50 l-h-60 rounded text-center">
                                                <span class="icon-Write fs-24"><span class="path1"></span><span
                                                        class="path2"></span></span>
                                            </div>
                                            <div class="d-flex flex-column fw-500">
                                                <a href="projects.html"
                                                    class="text-dark hover-danger mb-1 fs-16">Concept Design</a>
                                                <span class="text-fade">Art Director</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-success-light h-50 w-50 l-h-60 rounded text-center">
                                                <span class="icon-Group-chat fs-24"><span class="path1"></span><span
                                                        class="path2"></span></span>
                                            </div>
                                            <div class="d-flex flex-column fw-500">
                                                <a href="projects.html"
                                                    class="text-dark hover-success mb-1 fs-16">Functional Logics</a>
                                                <span class="text-fade">Lead Developer</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-info-light h-50 w-50 l-h-60 rounded text-center">
                                                <span class="icon-Attachment1 fs-24"><span class="path1"></span><span
                                                        class="path2"></span><span class="path3"></span><span
                                                        class="path4"></span></span>
                                            </div>
                                            <div class="d-flex flex-column fw-500">
                                                <a href="projects.html"
                                                    class="text-dark hover-info mb-1 fs-16">Development</a>
                                                <span class="text-fade">DevOps</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="me-15 bg-warning-light h-50 w-50 l-h-60 rounded text-center">
                                                <span class="icon-Shield-user fs-24"></span>
                                            </div>
                                            <div class="d-flex flex-column fw-500">
                                                <a href="projects.html"
                                                    class="text-dark hover-warning mb-1 fs-16">Testing</a>
                                                <span class="text-fade">QA Managers</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-30">
                                        <h5 class="fw-500 mb-15">Messages</h5>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                                <img src="https://crm-admin-dashboard-template.multipurposethemes.com/images/svg-icon/color-svg/001-glass.svg"
                                                    class="h-30" alt="">
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                                <a href="mailbox-read.html"
                                                    class="text-dark hover-primary mb-1 fs-16">Duis faucibus lorem</a>
                                                <span class="text-fade">Pharetra, Nulla</span>
                                            </div>
                                            <span class="badge badge-xl badge-light"><span
                                                    class="fw-600">+125$</span></span>
                                        </div>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                                <img src="https://crm-admin-dashboard-template.multipurposethemes.com/images/svg-icon/color-svg/002-google.svg"
                                                    class="h-30" alt="">
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                                <a href="mailbox-read.html"
                                                    class="text-dark hover-danger mb-1 fs-16">Mauris varius augue</a>
                                                <span class="text-fade">Pharetra, Nulla</span>
                                            </div>
                                            <span class="badge badge-xl badge-light"><span
                                                    class="fw-600">+125$</span></span>
                                        </div>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                                <img src="https://crm-admin-dashboard-template.multipurposethemes.com/images/svg-icon/color-svg/003-settings.svg"
                                                    class="h-30" alt="">
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                                <a href="mailbox-read.html"
                                                    class="text-dark hover-success mb-1 fs-16">Aliquam in magna</a>
                                                <span class="text-fade">Pharetra, Nulla</span>
                                            </div>
                                            <span class="badge badge-xl badge-light"><span
                                                    class="fw-600">+125$</span></span>
                                        </div>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                                <img src="https://crm-admin-dashboard-template.multipurposethemes.com/images/svg-icon/color-svg/004-dad.svg"
                                                    class="h-30" alt="">
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                                <a href="mailbox-read.html"
                                                    class="text-dark hover-info mb-1 fs-16">Phasellus venenatis nisi</a>
                                                <span class="text-fade">Pharetra, Nulla</span>
                                            </div>
                                            <span class="badge badge-xl badge-light"><span
                                                    class="fw-600">+125$</span></span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                                <img src="https://crm-admin-dashboard-template.multipurposethemes.com/images/svg-icon/color-svg/005-paint-palette.svg"
                                                    class="h-30" alt="">
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                                <a href="mailbox-read.html"
                                                    class="text-dark hover-warning mb-1 fs-16">Vivamus consectetur</a>
                                                <span class="text-fade">Pharetra, Nulla</span>
                                            </div>
                                            <span class="badge badge-xl badge-light"><span
                                                    class="fw-600">+125$</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="quick_panel_settings" role="tabpanel">
                                    <div>
                                        <form class="form">
                                            <!--begin::Section-->
                                            <div>
                                                <h5 class="fw-500 mb-15">Support</h5>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Enable Notifications:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button"
                                                            class="btn btn-sm btn-toggle btn-primary active"
                                                            data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Enable Case Tracking:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-toggle btn-primary"
                                                            data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Support Portal:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button"
                                                            class="btn btn-sm btn-toggle btn-primary active"
                                                            data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Section-->
                                            <div class="dropdown-divider"></div>
                                            <!--begin::Section-->
                                            <div class="pt-2">
                                                <h5 class="fw-500 mb-15">Overview </h5>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Generate Overview:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button"
                                                            class="btn btn-sm btn-toggle btn-danger active"
                                                            data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Enable Overview Export:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button"
                                                            class="btn btn-sm btn-toggle btn-danger active"
                                                            data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Allow Data Collection:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button"
                                                            class="btn btn-sm btn-toggle btn-danger active"
                                                            data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Section-->
                                            <div class="dropdown-divider"></div>
                                            <!--begin::Section-->
                                            <div class="pt-2">
                                                <h5 class="fw-500 mb-15">Users</h5>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Enable Users singup:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button"
                                                            class="btn btn-sm btn-toggle btn-warning active"
                                                            data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Allow User Feedbacks:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button"
                                                            class="btn btn-sm btn-toggle btn-warning active"
                                                            data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Enable Users Portal:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button"
                                                            class="btn btn-sm btn-toggle btn-warning active"
                                                            data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Section-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /quick_panel_toggle -->

    </div>
    

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="ratio ratio-16x9">
                    <iframe
                        src="http://player.vimeo.com/video/473177594?title=0&amp;portrait=0&amp;byline=0&amp;autoplay=1"
                        title="video" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade evemt-view" id="evemt-view">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1110px; width: 95%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Event Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row">
                    <div class="col-xl-8 pe-xl-0">
                        <div class="card text-white mb-0 b-0" style="margin-bottom: 0 !important;">
                            <img class="card-img" src="{{ asset('assets/images/preview/bg.jpg') }}" alt="Card image">
                            <div class="card-img-overlay">
                                <div class="row justify-content-between">
                                    <div class="col-auto bg-dark rounded">
                                        <h3 class="mt-5">Annual client Management Program 2021</h3>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-danger">CREAT</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-4 ps-xl-0">
                        <div class="card no-shadow b-0" style="margin-bottom: 0 !important;">
                            <div class="test">
                                <div class="card-header d-block">
                                    <div class="media p-0">
                                        <img class="img-fluid w-50 ms-0" src="{{ asset('assets/images/avatar/1.jpg') }}"
                                            alt="placeholder image">
                                        <div class="media-body">
                                            <h4 class="mt-0">By John Doe</h4>
                                            <p>5 min ago</p>
                                        </div>

                                        <div class="dropdown custom-dropdown">
                                            <div data-bs-toggle="dropdown">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Option 1</a>
                                                <a class="dropdown-item" href="#">Option 2</a>
                                                <a class="dropdown-item" href="#">Option 3</a>
                                            </div>
                                        </div>

                                    </div>
                                    <p class="mt-10 ms-0">Sed egestas mauris sit amet orci dignissim, vel pulvinar nisi
                                        faucibus. Duis gravida
                                        sem eu magna ornare, quis elementum lacus accumsan. Vestibulum eu efficitur
                                        nisl,
                                        in fringilla sapien.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <h5 class="fw-500">Date</h5>
                                            <p class="mb-0 fs-14">June 16, 2021</p>
                                        </div>
                                        <div class="col-auto">
                                            <h5 class="fw-500">Location</h5>
                                            <p class="mb-0 fs-14">NYC</p>
                                        </div>
                                        <div class="col-auto">
                                            <h5 class="fw-500">Tickets</h5>
                                            <p class="mb-0 fs-14">Avb. 26/ 100</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-lighter bt-1 bb-1 p-15">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h5 class="mb-0 me-10 fs-14 d-inline-block">Sponsor by</h5>
                                            <div class="d-inline-block">
                                                <a href="#">
                                                    <img class="img-fluid w-30" src="{{ asset('assets/images/avatar/3.jpg') }}"
                                                        alt="placeholder image">
                                                </a>
                                                <a href="#">
                                                    <img class="img-fluid w-30" src="{{ asset('assets/images/avatar/4.jpg') }}"
                                                        alt="placeholder image">
                                                </a>
                                                <a href="#">
                                                    <img class="img-fluid w-30" src="{{ asset('assets/images/avatar/5.jpg') }}"
                                                        alt="placeholder image">
                                                </a>
                                                <a href="#">
                                                    <img class="img-fluid w-30" src="{{ asset('assets/images/avatar/6.jpg') }}"
                                                        alt="placeholder image">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <p class="mb-0 text-danger fw-500">Free</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content overlay -->


    <!-- Vendor JS -->
    <script src="{{ asset('assets/src/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>

    {{-- <script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/cdn.amcharts.com/lib/4/core.js') }}"></script>
    <script src="{{ asset('assets/cdn.amcharts.com/lib/4/charts.js') }}"></script>
    <script src="{{ asset('assets/cdn.amcharts.com/lib/4/themes/animated.js') }}"></script> --}}

    
	<script src="{{ asset('assets/vendor_components/gallery/js/animated-masonry-gallery.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/gallery/js/jquery.isotope.min.js') }}"></script>
	<script src="{{ asset('assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script>	

    <!-- CRMi App -->
    <script src="{{ asset('assets/src/js/template.js') }}"></script>
    {{-- <script src="{{ asset('assets/src/js/pages/dashboard.js') }}"></script> --}}

    @stack('modals')

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>

    @stack('scripts')

</body>

</html>

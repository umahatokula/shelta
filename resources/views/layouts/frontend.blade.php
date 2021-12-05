<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Real Estate App') }}</title>

    <!-- Bootstrap Css -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('frontend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('frontend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
    <script src="{{ asset('assets/js/alpine.min.js') }}"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body data-layout="detached" data-topbar="colored">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('frontend.partials.header')
            
            <!-- ========== Left Sidebar Start ========== -->
            @include('frontend.partials.aside')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">

                    @yield('content')

                </div>
                <!-- End Page-content -->

                @include('frontend.partials.footer')
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    </div>
    <!-- end container-fluid -->


    <!-- JAVASCRIPT -->
    <script src="{{ asset('frontend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('frontend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/pages/dashboard-2.init.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('body').on('click', '[data-toggle="modal"]', function () {
                url = $(this).data("remote")
                console.log(url)
                $($(this).data("target") + ' .modal-body').load(url);
            });

            $('#confirmationModal').on('show.bs.modal', function (e) {
                $(this).find('.confirm').attr('href', $(e.relatedTarget).data('href'));
            });

        });

    </script>

</body>

</html>

<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">               
                <p>
                    loading...
                </p>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

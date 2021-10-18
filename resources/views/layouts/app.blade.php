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

    </div>


    <!-- Modal -->
    <div class="modal center-modal fade" id="confirmationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Your content comes here</p>
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    <button wire:click="destroy" type="button" class="btn btn-success float-end">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

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
    <script src="{{ asset('assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}">
    </script>
    <script src="{{ asset('assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}">
    </script>

    <!-- CRMi App -->
    <script src="{{ asset('assets/src/js/template.js') }}"></script>
    {{-- <script src="{{ asset('assets/src/js/pages/dashboard.js') }}"></script> --}}

    <script>
        window.addEventListener('show-confirmation-modal', event => {
            console.log(event)
            $('#confirmationModal').modal('show')
            $('#confirmationModal ').html('show')
        })

    </script>

    {{-- Alpine Js --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.min.js" defer></script>


    @stack('modals')

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false"></script>

    @stack('scripts')

</body>

</html>

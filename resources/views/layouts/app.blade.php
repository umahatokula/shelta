<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>{{ config('app.name', 'Real Estate App') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    @include('imports.stylesheets')

    <!-- Scripts -->
    <script src="{{ asset('assets/js/alpine.min.js') }}" defer></script>
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @livewireStyles

</head>
<body>

    @php
        $settings = App\Models\Setting::first();
        $logoLight = $settings ? $settings->getFirstMediaUrl('logoLight') : '';
        $logoDark = $settings ? $settings->getFirstMediaUrl('logoDark') : '';
    @endphp

    <div class="app sidebar-colored align-content-stretch d-flex flex-wrap">

        @auth
            {{-- sidebar start --}}
            @include('partials.sidebar')
            {{-- sidebar end --}}
        @endauth

        <div class="app-container">
            @auth
                {{-- searchbar start --}}
                @include('partials.searchbar')
                {{-- searchbar end --}}
            @endauth

            @auth
                {{-- header start --}}
                @include('partials.header')
                {{-- header end --}}
            @endauth

            {{-- page content start --}}
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container-fluid">

                        @yield('content')

                    </div>
                </div>
            </div>
            {{-- page content end --}}
        </div>
    </div>

    @include('imports.javascripts')

    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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

        window.addEventListener('showToastr', event => {
            toastr[event.detail.type](event.detail.message)
        })

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "3000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

    </script>

    @livewire('modal')

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false"></script>

    @stack('scripts')


    @yield('javascript')
</body>
</html>




<div class="modal fade" id="modal-center" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">&nbsp;</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>loading...</p>
            </div>
        </div>
    </div>
</div>

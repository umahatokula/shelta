<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Real Estate App') }}</title>
        
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.html">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/images/fav.png') }}">
        <!-- Bootstrap v4.4.1 css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
        <!-- font-awesome css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/font-awesome.min.css') }}">
        <!-- flaticon css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/fonts/flaticon.css') }}">
        <!-- animate css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/animate.css') }}">
        <!-- owl.carousel css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
        <!-- off canvas css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/off-canvas.css') }}">
        <!-- magnific popup css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/magnific-popup.css') }}">
        <!-- Main Menu css -->
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/rsmenu-main.css') }}">
        <!-- nivo slider CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/inc/custom-slider/css/nivo-slider.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/inc/custom-slider/css/preview.css') }}">
        <!-- spacing css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/rs-spacing.css') }}">
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css') }}"> <!-- This stylesheet dynamically changed from style.less -->
        <!-- responsive css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/responsive.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('assets/js/alpine.min.js') }}"></script>
        <script src="//unpkg.com/alpinejs" defer></script>

        <!-- Toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
        @livewireStyles
        
    </head>

    <body class="defult-home">

        @php
            $settings = App\Models\Setting::first();
            $logoLight = $settings ? $settings->getFirstMediaUrl('logoLight') : '';
            $logoDark = $settings ? $settings->getFirstMediaUrl('logoDark') : '';
        @endphp
        
        <div class="offwrap"></div>
     
		<!-- Main content Start -->
        <div class="main-content">

            
            <!--Full width header Start-->
            <div class="full-width-header">
                <!--Header Start-->
                @include('frontend.partials.header')
                <!--Header End-->
            </div>
            <!--Full width header End-->
            
            @yield('content')
            
        </div> 
        <!-- Main content End -->

        <!-- Footer Start -->
        @include('frontend.partials.footer')
        <!-- Footer End -->

        <!-- start scrollUp  -->
        <div id="scrollUp" class="orange-color">
            <i class="fa fa-angle-up"></i>
        </div>
        <!-- End scrollUp  -->

        <!-- Search Modal Start -->
        <div class="modal fade search-modal" id="searchModal" tabindex="-1">
            <button type="button" class="close" data-bs-dismiss="modal">
                <span class="flaticon-cross"></span>
            </button>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="search-block clearfix">
                        <form>
                            <div class="form-group">
                                <input class="form-control" placeholder="Search Here..." type="text">
                                <button type="submit" value="Search"><i class="flaticon-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search Modal End -->
    
        
        <!-- modernizr js -->
        <script src="{{ asset('frontend/assets/js/modernizr-2.8.3.min.js') }}"></script>
        <!-- jquery latest version -->
        <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
        <!-- Bootstrap v4.4.1 js -->
        <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
        <!-- op nav js -->
        <script src="{{ asset('frontend/assets/js/jquery.nav.js') }}"></script>
        <!-- isotope.pkgd.min js -->
        <script src="{{ asset('frontend/assets/js/isotope.pkgd.min.js') }}"></script>
        <!-- owl.carousel js -->
        <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
        <!-- wow js -->
        <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
        <!-- Skill bar js -->
        <script src="{{ asset('frontend/assets/js/skill.bars.jquery.js') }}"></script>
        <!-- imagesloaded js -->
        <script src="{{ asset('frontend/assets/js/imagesloaded.pkgd.min.js') }}"></script>
         <!-- waypoints.min js -->
        <script src="{{ asset('frontend/assets/js/waypoints.min.js') }}"></script>
        <!-- counterup.min js -->
        <script src="{{ asset('frontend/assets/js/jquery.counterup.min.js') }}"></script> 
        <!-- magnific popup js -->
        <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
        <!-- Nivo slider js -->
        <script src="{{ asset('frontend/assets/inc/custom-slider/js/jquery.nivo.slider.js') }}"></script>
        <!-- contact form js -->
        <script src="{{ asset('frontend/assets/js/contact.form.js') }}"></script>
        <!-- main js -->
        <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

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



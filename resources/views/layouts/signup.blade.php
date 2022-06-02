<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Form - RICHBOSS Realty</title>
    <link rel="stylesheet" href="{{asset('signup/css/style.css') }}">
    <link rel="shortcut icon" href="{{asset('signup/img/favicon.png') }}" type="image/x-icon">
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <!-- <script src="js/scrollreveal.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script> -->

    @stack('css')

    @livewireStyles

</head>




<body>
<header>
    <div class="logoside">
        <a href="../index.html"><img src="{{asset('signup/img/logo.png')}}" width="250px"></a>
    </div>
    <div class="menuside">
    </div>
    <div class="callside">
        <div class="topcall">
            <span class="iconify" data-icon="bxs:home" style="font-size: 25px;"></span> &nbsp; <a
                href="https://richbossrealty.com" target="_blank">Main Site</a> </div>
    </div>


    <div class="mobilenav">
        <nav role='navigation'>
            <div id="menuToggle">
                <input type="checkbox" />
                <span></span>
                <span></span>
                <span></span>
                <ul id="menu">
                    <div class="topcall">
                        <span class="iconify" data-icon="bxs:home" style="font-size: 25px;"></span> &nbsp; <a href="https://richbossrealty.com" target="_blank">Main Site</a> </div>
                </ul>
            </div>
        </nav>
    </div>
</header>

<!-- Header ends here -->
<!-- <div class="whatsapp"></div> -->

@yield('content')

<!-- Footer starts -->
<div class="footnote">
    © Richboss Realty 2022 - RC1796250. All Rights Reserved
</div>

@stack('scripts')

@livewire('modal')

@livewireScripts

</body>

</html>

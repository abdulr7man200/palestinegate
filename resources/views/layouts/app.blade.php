<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Palestine Gate</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <link rel="stylesheet" type="text/css" href="{{ url("Frontend/fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700")}}">
        <link rel="stylesheet" href="{{ url('Frontend/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ url('Frontend/css/animate.css')}}">
        <link rel="stylesheet" href="{{ url('Frontend/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{ url('Frontend/css/aos.css')}}">
        <link rel="stylesheet" href="{{ url('Frontend/css/bootstrap-datepicker.css')}}">
        <link rel="stylesheet" href="{{ url('Frontend/css/jquery.timepicker.css')}}">
        <link rel="stylesheet" href="{{ url('Frontend/css/fancybox.min.css')}}">
        <link rel="stylesheet" href="{{ url('Frontend/fonts/ionicons/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{ url('Frontend/fonts/fontawesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{ url('Frontend/css/style.css')}}">
        <link rel="stylesheet" href="{{ url('Frontend/css/cards.css')}}">
        <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

           @yield('content')

           @include('layouts.footer')
        </div>

        {{-- <script src="{{ url('Frontend/js/jquery-3.3.1.min.js') }}"></script> --}}
        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="{{ url('Frontend/js/jquery-migrate-3.0.1.min.js') }}"></script>
        <script src="{{ url('Frontend/js/popper.min.js') }}"></script>
        <script src="{{ url('Frontend/js/bootstrap.min.js')}}"></script>
        <script src="{{ url('Frontend/js/owl.carousel.min.js')}}"></script>
        <script src="{{ url('Frontend/js/jquery.stellar.min.js')}}"></script>
        <script src="{{ url('Frontend/js/jquery.fancybox.min.js')}}"></script>


        <script src="{{ url('Frontend/js/aos.js')}}"></script>

        <script src="{{ url('Frontend/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{ url('Frontend/js/jquery.timepicker.min.js')}}"></script>



        <script src="{{ url('Frontend/js/main.js')}}"></script>
        <script src="{{ url('Frontend/js/cards.js')}}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>


    </body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name') }} | @yield('title') </title>
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- jQuery (nécessaire pour toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/line-icons.css') }}">
    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slicknav.css') }}">
    <!-- Nivo Lightbox -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/nivo-lightbox.css') }}">
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
    <!-- Responsive Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

    <!-- Custom Navigation Styles -->
    <style>
        .navbar-nav .nav-link {
            color: #E91E63 !important; /* Rose vif */
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #C2185B !important; /* Rose plus foncé au survol */
            transform: translateY(-2px);
        }

        .navbar-nav .nav-item.active .nav-link {
            color: #AD1457 !important; /* Rose encore plus foncé pour le lien actif */
            font-weight: 600;
        }

        .btn-border {
            border-color: #E91E63 !important;
            color: #E91E63 !important;
        }

        .btn-border:hover {
            background-color: #E91E63 !important;
            color: white !important;
        }

        /* Style pour le nom de l'utilisateur */
        .navbar-nav .nav-item p {
            color: #E91E63;
            margin: 0;
            padding: 8px 15px;
            font-weight: 500;
        }

        /* Style pour la navigation mobile */
        .mobile-menu a {
            color: #E91E63 !important;
        }

        .mobile-menu a:hover {
            color: #C2185B !important;
        }
    </style>

</head>

<body>


    @include('includes.header')

    @yield('content')
    @include('includes.contact')

    @include('includes.footer')
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000", // Durée d'affichage : 5 secondes
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            // @if (session('success'))
            //     toastr.success("{{ session('success') }}");
            // @endif

            // @if (session('error'))
            //     toastr.error("{{ session('error') }}");
            // @endif

            // @if (session('info'))
            //     toastr.info("{{ session('info') }}");
            // @endif

            // @if (session('warning'))
            //     toastr.warning("{{ session('warning') }}");
            // @endif
         });
    </script>
</body>

</html>

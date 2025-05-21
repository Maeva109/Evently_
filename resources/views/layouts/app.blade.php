<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Evently') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.css') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Header Area wrapper -->
    <header id="header-wrap">
        <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a href="{{ route('home') }}" class="navbar-brand">
                        <span class="text-primary">Event</span>ly
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}" href="{{ route('events.index') }}">
                                Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('gallery.index') ? 'active' : '' }}" href="{{ route('gallery.index') }}">
                                Gallery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('blog.index') ? 'active' : '' }}" href="{{ route('blog.index') }}">
                                Blog
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('signin') }}">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary" href="{{ route('organizer.register') }}">Become Organizer</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->role === 'admin')
                                        <li><a class="dropdown-item" href="{{ route('admin.home') }}">Admin Dashboard</a></li>
                                    @endif
                                    @if(Auth::user()->role === 'organizer')
                                        <li><a class="dropdown-item" href="{{ route('organizer.dashboard') }}">Organizer Dashboard</a></li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer Area -->
    <footer class="footer-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12">
                    <h3 class="footer-titel">About Us</h3>
                    <p>
                        Evently is your go-to platform for discovering and organizing amazing events.
                        Join us to explore a world of possibilities.
                    </p>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12">
                    <h3 class="footer-titel">Quick Links</h3>
                    <ul class="footer-link">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('events.index') }}">Events</a></li>
                        <li><a href="{{ route('gallery.index') }}">Gallery</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12">
                    <h3 class="footer-titel">Find Events</h3>
                    <ul class="footer-link">
                        <li><a href="{{ route('events.featured') }}">Featured Events</a></li>
                        <li><a href="{{ route('events.schedules') }}">Event Schedule</a></li>
                        <li><a href="{{ route('organizers.index') }}">Event Organizers</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12">
                    <h3 class="footer-titel">Contact</h3>
                    <ul class="address">
                        <li>
                            <a href="mailto:contact@evently.com">
                                <i class="lni-envelope"></i> contact@evently.com
                            </a>
                        </li>
                        <li>
                            <a href="tel:+1234567890">
                                <i class="lni-phone-handset"></i> +1 234 567 890
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-bottom">
                        <p>© {{ date('Y') }} Evently. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Wow JS -->
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    <script>
        new WOW().init();

        // Handle hash redirect for #schedules
        if (window.location.hash === '#schedules') {
            window.location.href = '/schedules';
        }
    </script>

    @stack('scripts')
</body>
</html> 
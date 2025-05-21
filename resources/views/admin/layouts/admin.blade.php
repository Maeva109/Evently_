<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - {{ config('app.name') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
    <style>
        :root {
            --primary-color: #E91E63;
            --primary-dark: #C2185B;
            --secondary-color: #2C3E50;
            --accent-color: #FF4081;
            --light-bg: #f8f9fa;
            --dark-bg: #1a1c23;
            --success-color: #2ecc71;
            --warning-color: #f1c40f;
            --danger-color: #e74c3c;
            --text-primary: #2C3E50;
            --text-secondary: #95a5a6;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-primary);
        }

        /* Sidebar */
        .sidebar {
            background-color: var(--dark-bg);
            min-height: 100vh;
            box-shadow: 0 0 35px 0 rgba(49, 57, 66, 0.1);
        }

        .sidebar-header {
            padding: 1.5rem;
            background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
            color: white;
            text-align: center;
        }

        .sidebar-brand {
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .nav-link {
            color: #fff !important;
            padding: 0.8rem 1rem;
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            margin: 0.2rem 0;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            padding-left: 1.5rem;
        }

        .nav-link i {
            width: 1.5rem;
            margin-right: 0.75rem;
        }

        /* Main content */
        .main-content {
            padding: 2rem;
        }

        /* Top navbar */
        .top-navbar {
            background-color: #fff;
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,.05);
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0,0,0,.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 0 30px rgba(0,0,0,.1);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0,0,0,.05);
            padding: 1.25rem;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* Tables */
        .table th {
            font-weight: 600;
            background-color: rgba(0,0,0,.02);
        }

        .table td {
            vertical-align: middle;
        }

        /* Utilities */
        .nav-section {
            margin-bottom: 1.5rem;
        }

        .nav-section-title {
            color: var(--text-secondary);
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.5rem 1rem;
            margin-bottom: 0.5rem;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="sidebar-header">
                    <a href="{{ route('admin.home') }}" class="sidebar-brand">
                        <span>Event</span>ly
                    </a>
                </div>
                <div class="position-sticky pt-3">
                    <!-- Main Navigation -->
                    <div class="nav-section">
                        <div class="nav-section-title">Main</div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}" 
                                   href="{{ route('admin.home') }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.events.index') }}">
                                    <i class="fas fa-calendar-alt"></i>
                                    Events
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.bookings.index') }}">
                                    <i class="fas fa-ticket-alt"></i>
                                    Bookings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.categories.index') }}">
                                    <i class="fas fa-tags"></i>
                                    Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.users.index') }}">
                                    <i class="fas fa-users"></i>
                                    Users
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Management -->
                    <div class="nav-section">
                        <div class="nav-section-title">Management</div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-users"></i>
                                    Users
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-user-tie"></i>
                                    Organizers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-ticket-alt"></i>
                                    Bookings
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Settings -->
                    <div class="nav-section">
                        <div class="nav-section-title">Settings</div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-cog"></i>
                                    General Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-bell"></i>
                                    Notifications
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Top navbar -->
                <div class="top-navbar">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">Welcome, {{ Auth::user()->name ?? 'Admin' }}</h4>
                            <small class="text-muted">{{ now()->format('l, F j, Y') }}</small>
                        </div>
                        <ul class="nav">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link" title="View Site">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" title="Notifications">
                                    <i class="fas fa-bell"></i>
                                    <span class="badge rounded-pill bg-danger" style="font-size: 0.5rem; position: absolute; top: 0; right: 0;">2</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="/logout" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    @stack('scripts')
</body>
</html> 
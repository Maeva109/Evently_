    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              <span class="icon-menu"></span>
              <span class="icon-menu"></span>
              <span class="icon-menu"></span>
            </button>
            <a href="/" class="navbar-brand"><img src="assets/img/logo.png" alt=""></a>
          </div>
          <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="navbar-nav mr-auto w-100 justify-content-end">
              <li class="nav-item active">
                <a class="nav-link" href="#header-wrap">
                  Home
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#about">
                  About
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('events.schedules') }}">
                  Schedules
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#gallery">
                  Gallery
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#faq">
                  Faq
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#sponsors">
                  Sponsors
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#google-map-area">
                  Contact
                </a>
              </li>
              @auth
              <li class="nav-item">
              <p> {{ auth()->user()->name }} </p>
            </li>
            <li class="nav-item">
              <a href="/logout" class="nav-link fadeInUp wow btn btn-border btn-lg" data-wow-delay=".8s">Logout</a>
            </li>
                @else
              
              <li class="nav-item">
                <a href="/signin" class="nav-link fadeInUp wow btn btn-border btn-lg" data-wow-delay=".8s">Login</a>
              </li>
              <li class="nav-item">
                <a href="/signup" class="nav-link fadeInUp btn btn-border btn-lg" data-wow-delay=".8s">Signin</a>
              </li>
              @endauth
            </ul>
          </div>
        </div>

        <!-- Mobile Menu Start -->
        <ul class="mobile-menu">
          <li>
            <a class="page-scrool" href="#header-wrap">Home</a>
          </li>
          <li>
            <a class="page-scrool" href="#about">About</a>
          </li>
          <li>
             <a class="page-scroll" href="{{ route('events.schedules') }}">Schedules</a>
          </li>
          <li>
            <a class="page-scroll" href="#team">Speakers</a>
          </li>
          <li>
            <a class="page-scroll" href="#gallery">Gallery</a>
          </li>
          <li>
            <a class="page-scroll" href="#faq">Faq</a>
          </li>
          <li>
            <a class="page-scroll" href="#sponsors">Sponsors</a>
          </li>
          <li>
            <a class="page-scroll" href="#pricing">pricing</a>
          </li>
          <li>
            <a class="page-scroll" href="#google-map-area">Contact</a>
          </li>
        </ul>
        <!-- Mobile Menu End -->

      </nav>
      <!-- Navbar End -->

      <!-- Main Carousel Section Start -->
        <!-- Main Carousel Section End -->

</header>
     
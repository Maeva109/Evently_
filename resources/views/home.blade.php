@extends('layout')
@section('title','Home')
@section('content')
<div id="main-slide" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#main-slide" data-slide-to="0" class="active"></li>
    <li data-target="#main-slide" data-slide-to="1"></li>
    <li data-target="#main-slide" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="assets/img/slider/slide1.jpg" alt="Featured Events">
      <div class="carousel-caption d-md-block">
        <p class="fadeInUp wow" data-wow-delay=".6s">Discover Amazing Events Near You</p>
        <h1 class="wow fadeInDown heading" data-wow-delay=".4s">Find Your Next Experience</h1>
        <a href="{{ route('events.index') }}" class="fadeInLeft wow btn btn-common btn-lg" data-wow-delay=".6s">Browse Events</a>
        <a href="{{ route('events.create') }}" class="fadeInRight wow btn btn-border btn-lg" data-wow-delay=".6s">Create Event</a>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="assets/img/slider/slide2.jpg" alt="Event Organizers">
      <div class="carousel-caption d-md-block">
        <p class="fadeInUp wow" data-wow-delay=".6s">Join Our Community of Event Organizers</p>
        <h1 class="wow bounceIn heading" data-wow-delay=".7s">Create Memorable Events</h1>
        <a href="{{ route('organizer.register') }}" class="fadeInUp wow btn btn-border btn-lg" data-wow-delay=".8s">Become an Organizer</a>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="assets/img/slider/slide3.jpg" alt="Event Tickets">
      <div class="carousel-caption d-md-block">
        <p class="fadeInUp wow" data-wow-delay=".6s">Don't Miss Out on Amazing Events</p>
        <h1 class="wow fadeInUp heading" data-wow-delay=".6s">Book Your Tickets Now!</h1>
        <a href="{{ route('events.featured') }}" class="fadeInUp wow btn btn-common btn-lg" data-wow-delay=".8s">Featured Events</a>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#main-slide" role="button" data-slide="prev">
    <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-left"></i></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#main-slide" role="button" data-slide="next">
    <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-right"></i></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- Countdown Section Start -->
   <section class="countdown-timer section-padding">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="heading-count">
          <h2 class="wow fadeInDown" data-wow-delay="0.2s">Next Featured Event Starts In</h2>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row time-countdown justify-content-center wow fadeInUp" data-wow-delay="0.2s">
          <div id="clock" class="time-count" data-event-date="{{ $nextFeaturedEvent->start_date ?? '' }}"></div>
            </div>
        @if($nextFeaturedEvent)
        <a href="{{ route('events.show', $nextFeaturedEvent->id) }}" class="btn btn-common wow fadeInUp" data-wow-delay="0.3s">View Event Details</a>
        @endif
          </div>
        </div>
      </div>
    </section>
<!-- Countdown Section End -->

     <!-- Services Section Start -->
    <section id="services" class="services section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-title-header text-center">
          <h1 class="section-title wow fadeInUp" data-wow-delay="0.2s">Why Choose Our Platform?</h1>
          <p class="wow fadeInDown" data-wow-delay="0.2s">The Best Place to Find and Create Events</p>
            </div>
          </div>
        </div>
        <div class="row services-wrapper">
          <!-- Services item -->
          <div class="col-md-6 col-lg-4 col-xs-12 padding-none">
            <div class="services-item wow fadeInDown" data-wow-delay="0.2s">
              <div class="icon">
            <i class="lni-search"></i>
              </div>
              <div class="services-content">
            <h3><a href="#">Easy Event Discovery</a></h3>
            <p>Find events that match your interests with our smart search and filtering system.</p>
              </div>
            </div>
          </div>
          <!-- Services item -->
          <div class="col-md-6 col-lg-4 col-xs-12 padding-none">
            <div class="services-item wow fadeInDown" data-wow-delay="0.4s">
              <div class="icon">
            <i class="lni-ticket"></i>
              </div>
              <div class="services-content">
            <h3><a href="#">Simple Booking Process</a></h3>
            <p>Book tickets and register for events with just a few clicks.</p>
              </div>
            </div>
          </div>
          <!-- Services item -->
          <div class="col-md-6 col-lg-4 col-xs-12 padding-none">
            <div class="services-item wow fadeInDown" data-wow-delay="0.6s">
              <div class="icon">
            <i class="lni-calendar"></i>
              </div>
              <div class="services-content">
            <h3><a href="#">Event Management</a></h3>
            <p>Create and manage your events with our comprehensive tools and features.</p>
              </div>
            </div>
          </div>
          <!-- Services item -->
          <div class="col-md-6 col-lg-4 col-xs-12 padding-none">
            <div class="services-item wow fadeInDown" data-wow-delay="0.8s">
              <div class="icon">
            <i class="lni-users"></i>
              </div>
              <div class="services-content">
            <h3><a href="#">Community Building</a></h3>
            <p>Connect with other event organizers and attendees in your area.</p>
              </div>
            </div>
          </div>
           <!-- Services item -->
          <div class="col-md-6 col-lg-4 col-xs-12 padding-none">
            <div class="services-item wow fadeInDown" data-wow-delay="1s">
              <div class="icon">
            <i class="lni-stats-up"></i>
              </div>
              <div class="services-content">
            <h3><a href="#">Analytics & Insights</a></h3>
            <p>Track your event performance with detailed analytics and reporting.</p>
              </div>
            </div>
          </div>
           <!-- Services item -->
          <div class="col-md-6 col-lg-4 col-xs-12 padding-none">
            <div class="services-item wow fadeInDown" data-wow-delay="1.2s">
              <div class="icon">
            <i class="lni-support"></i>
              </div>
              <div class="services-content">
            <h3><a href="#">24/7 Support</a></h3>
            <p>Get help whenever you need it with our dedicated support team.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Services Section End -->

    <!-- About Section Start -->
    <section id="about" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-title-header text-center">
          <h1 class="section-title wow fadeInUp" data-wow-delay="0.2s">About Our Platform</h1>
          <p class="wow fadeInDown" data-wow-delay="0.2s">Your One-Stop Solution for Event Management</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="about-item">
          <img class="img-fluid" src="assets/img/about/img1.jpg" alt="For Attendees">
              <div class="about-text">
            <h3><a href="#">For Event Attendees</a></h3>
            <p>Discover and attend amazing events in your area. From conferences to workshops, find experiences that match your interests.</p>
            <a class="btn btn-common btn-rm" href="{{ route('events.index') }}">Find Events</a>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="about-item">
          <img class="img-fluid" src="assets/img/about/img2.jpg" alt="For Organizers">
              <div class="about-text">
            <h3><a href="#">For Event Organizers</a></h3>
            <p>Create and manage successful events with our powerful tools. Reach your target audience and grow your community.</p>
            <a class="btn btn-common btn-rm" href="{{ route('organizer.dashboard') }}">Start Organizing</a>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="about-item">
          <img class="img-fluid" src="assets/img/about/img3.jpg" alt="Platform Benefits">
              <div class="about-text">
            <h3><a href="#">Platform Benefits</a></h3>
            <p>Enjoy secure payments, detailed analytics, marketing tools, and excellent support to make your events successful.</p>
            <a class="btn btn-common btn-rm" href="{{ route('features') }}">Learn More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- About Section End -->

<!-- Counter Area Start -->
    <section class="counter-section section-padding">
      <div class="container">
        <div class="row">
          <!-- Counter Item -->
          <div class="col-md-6 col-lg-3 col-xs-12 work-counter-widget text-center">
            <div class="counter wow fadeInRight" data-wow-delay="0.3s">
          <div class="icon"><i class="lni-calendar"></i></div>
          <p>{{ $totalEvents }} Events</p>
          <span>Created on our platform</span>
            </div>
          </div>
          <!-- Counter Item -->
          <div class="col-md-6 col-lg-3 col-xs-12 work-counter-widget text-center">
            <div class="counter wow fadeInRight" data-wow-delay="0.6s">
          <div class="icon"><i class="lni-users"></i></div>
          <p>{{ $totalOrganizers }} Organizers</p>
          <span>Trust our platform</span>
            </div>
          </div>
          <!-- Counter Item -->
          <div class="col-md-6 col-lg-3 col-xs-12 work-counter-widget text-center">
            <div class="counter wow fadeInRight" data-wow-delay="0.9s">
          <div class="icon"><i class="lni-ticket"></i></div>
          <p>{{ $totalBookings }} Bookings</p>
          <span>Successfully completed</span>
            </div>
          </div>
          <!-- Counter Item -->
          <div class="col-md-6 col-lg-3 col-xs-12 work-counter-widget text-center">
            <div class="counter wow fadeInRight" data-wow-delay="1.2s">
          <div class="icon"><i class="lni-map"></i></div>
          <p>{{ $totalLocations }} Locations</p>
          <span>Across the country</span>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- Counter Area End -->

    <!-- Team Section Start -->
    <section id="team" class="section-padding text-center">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-title-header text-center">
          <h1 class="section-title wow fadeInUp" data-wow-delay="0.2s">Featured Event Organizers</h1>
          <p class="wow fadeInDown" data-wow-delay="0.2s">Meet Our Top Event Creators</p>
            </div>
          </div>
        </div>
        <div class="row">
      @foreach($featuredOrganizers as $organizer)
          <div class="col-sm-6 col-md-6 col-lg-4">
            <!-- Team Item Starts -->
            <div class="team-item wow fadeInUp" data-wow-delay="0.2s">
              <div class="team-img">
            <img class="img-fluid" src="{{ $organizer->profile_image }}" alt="{{ $organizer->name }}">
                <div class="team-overlay">
                  <div class="overlay-social-icon text-center">
                    <ul class="social-icons">
                  <li><a href="{{ $organizer->social_links['facebook'] ?? '#' }}"><i class="lni-facebook-filled" aria-hidden="true"></i></a></li>
                  <li><a href="{{ $organizer->social_links['twitter'] ?? '#' }}"><i class="lni-twitter-filled" aria-hidden="true"></i></a></li>
                  <li><a href="{{ $organizer->social_links['linkedin'] ?? '#' }}"><i class="lni-linkedin-filled" aria-hidden="true"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="info-text">
            <h3><a href="{{ route('organizer.profile', $organizer->id) }}">{{ $organizer->name }}</a></h3>
            <p>{{ $organizer->events_count }} Events Created</p>
              </div>
            </div>
            <!-- Team Item Ends -->
          </div>
      @endforeach
                  </div>
    <a href="{{ route('organizers.index') }}" class="btn btn-common mt-30 wow fadeInUp" data-wow-delay="1.9s">View All Organizers</a>
      </div>
    </section>
    <!-- Team Section End -->

<!-- Gallery Section Start -->
    <section id="gallery" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-title-header text-center">
          <h1 class="section-title wow fadeInUp" data-wow-delay="0.2s">Event Highlights</h1>
          <p class="wow fadeInDown" data-wow-delay="0.2s">Moments from Our Recent Events</p>
            </div>
          </div> 
        </div>
        <div class="row">
      @foreach($eventGallery as $photo)
          <div class="col-md-6 col-sm-6 col-lg-4">
            <div class="gallery-box">
              <div class="img-thumb">
            <img class="img-fluid" src="{{ $photo->image_url }}" alt="{{ $photo->caption }}">
              </div>
              <div class="overlay-box text-center">
            <a class="lightbox" href="{{ $photo->image_url }}">
                  <i class="lni-plus"></i>
                </a>
              </div>
            </div>
          </div>
      @endforeach
        </div>
        <div class="row justify-content-center mt-3">
          <div class="col-xs-12">
        <a href="{{ route('gallery.index') }}" class="btn btn-common">View All Photos</a>
          </div>
        </div>
      </div>
    </section>
<!-- Gallery Section End -->

<!-- FAQ Section Start -->
    <section id="faq" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-title-header text-center">
          <h1 class="section-title wow fadeInUp" data-wow-delay="0.2s">Frequently Asked Questions</h1>
          <p class="wow fadeInDown" data-wow-delay="0.2s">Everything You Need to Know About Our Platform</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
            <div class="accordion">
              <div class="card">
                <div class="card-header" id="headingOne">
              <div class="header-title" data-toggle="collapse" data-target="#questionOne" aria-expanded="true" aria-controls="questionOne">
                <i class="lni-pencil"></i> How do I create an event?
                  </div>
                </div>
                <div id="questionOne" class="collapse" aria-labelledby="headingOne" data-parent="#question">
                  <div class="card-body">
                Creating an event is easy! Simply sign up as an organizer, click on "Create Event", and follow our step-by-step guide to set up your event details, tickets, and promotion.
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingTwo">
                    <div class="header-title" data-toggle="collapse" data-target="#questionTwo" aria-expanded="false" aria-controls="questionTwo">
                <i class="lni-credit-cards"></i> What payment methods do you accept?
                    </div>
                </div>
                <div id="questionTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#question">
                  <div class="card-body">
                We accept all major credit cards, debit cards, and digital payment methods including PayPal, Apple Pay, and Google Pay.
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
            <div class="accordion">
              <div class="card">
                <div class="card-header" id="headingThree">
              <div class="header-title" data-toggle="collapse" data-target="#questionThree" aria-expanded="false" aria-controls="questionThree">
                <i class="lni-ticket"></i> How do I manage my bookings?
                  </div>
                </div>
            <div id="questionThree" class="collapse" aria-labelledby="headingThree" data-parent="#question">
                  <div class="card-body">
                Access your bookings through your user dashboard. You can view event details, download tickets, and manage your registrations all in one place.
                  </div>
                </div>
              </div>
              <div class="card">
            <div class="card-header" id="headingFour">
              <div class="header-title" data-toggle="collapse" data-target="#questionFour" aria-expanded="false" aria-controls="questionFour">
                <i class="lni-reload"></i> What is your refund policy?
                  </div>
                </div>
            <div id="questionFour" class="collapse" aria-labelledby="headingFour" data-parent="#question">
                  <div class="card-body">
                Refund policies vary by event. Each event listing includes specific refund terms set by the organizer. Generally, refunds are available up to 24 hours before the event.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- FAQ Section End -->

<!-- Pricing Section Start -->
    <section id="pricing" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-title-header text-center">
          <h1 class="section-title wow fadeInUp" data-wow-delay="0.2s">Organizer Plans</h1>
          <p class="wow fadeInDown" data-wow-delay="0.2s">Choose the Perfect Plan for Your Events</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-sm-6 col-xa-12 mb-3">
            <div class="price-block-wrapper wow fadeInLeft" data-wow-delay="0.2s">
              <div class="icon">
            <i class="lni-package"></i>
              </div>
              <div class="colmun-title">
            <h5>Basic Plan</h5>
              </div>
              <div class="price">
            <h2>Free</h2>
            <p>Perfect for Getting Started</p>
              </div>
              <div class="pricing-list">
                <ul>
              <li><i class="lni-check-mark-circle"></i><span class="text">Create up to 2 events</span></li>
              <li><i class="lni-check-mark-circle"></i><span class="text">Basic Analytics</span></li>
              <li><i class="lni-check-mark-circle"></i><span class="text">Email Support</span></li>
              <li><i class="lni-close"></i><span class="text">Custom Branding</span></li>
              <li><i class="lni-close"></i><span class="text">Priority Support</span></li>
                </ul>
              </div>
          <a href="{{ route('organizer.register') }}" class="btn btn-common">Get Started</a>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-xa-12 mb-3">
            <div class="price-block-wrapper wow fadeInUp" data-wow-delay="0.3s">
              <div class="icon">
            <i class="lni-star"></i>
              </div>
              <div class="colmun-title">
            <h5>Professional</h5>
              </div>
              <div class="price">
            <h2>$29/mo</h2>
            <p>For Growing Organizations</p>
              </div>
              <div class="pricing-list">
                <ul>
              <li><i class="lni-check-mark-circle"></i><span class="text">Unlimited Events</span></li>
              <li><i class="lni-check-mark-circle"></i><span class="text">Advanced Analytics</span></li>
              <li><i class="lni-check-mark-circle"></i><span class="text">Priority Support</span></li>
              <li><i class="lni-check-mark-circle"></i><span class="text">Custom Branding</span></li>
              <li><i class="lni-close"></i><span class="text">API Access</span></li>
                </ul>
              </div>
          <a href="{{ route('plans.professional') }}" class="btn btn-common">Upgrade Now</a>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 col-xa-12 mb-3">
            <div class="price-block-wrapper wow fadeInRight" data-wow-delay="0.4s">
              <div class="icon">
            <i class="lni-diamond"></i>
              </div>
              <div class="colmun-title">
            <h5>Enterprise</h5>
              </div>
              <div class="price">
            <h2>$99/mo</h2>
            <p>For Large Organizations</p>
              </div>
              <div class="pricing-list">
                <ul>
              <li><i class="lni-check-mark-circle"></i><span class="text">Everything in Professional</span></li>
              <li><i class="lni-check-mark-circle"></i><span class="text">API Access</span></li>
              <li><i class="lni-check-mark-circle"></i><span class="text">Dedicated Account Manager</span></li>
              <li><i class="lni-check-mark-circle"></i><span class="text">Custom Integration</span></li>
              <li><i class="lni-check-mark-circle"></i><span class="text">24/7 Phone Support</span></li>
                </ul>
              </div>
          <a href="{{ route('plans.enterprise') }}" class="btn btn-common">Contact Sales</a>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- Pricing Section End -->

<!-- Event Guidelines Section Start -->
<section id="event-guidelines" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-title-header text-center">
          <h1 class="section-title wow fadeInUp" data-wow-delay="0.2s">Event Guidelines</h1>
          <p class="wow fadeInDown" data-wow-delay="0.2s">How to Make Your Event Successful</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xs-12 wow fadeInRight" data-wow-delay="0.3s">
            <div class="video">
          <img class="img-fluid" src="assets/img/about/event-guide.jpg" alt="Event Guidelines">
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xs-12 wow fadeInLeft" data-wow-delay="0.3s">
        <p class="intro-desc">Follow our comprehensive guide to create successful events that attendees will love and remember.</p>
        <h2 class="intro-title">Event Success Checklist</h2>
            <ul class="list-specification">
          <li><i class="lni-check-mark-circle"></i> Define your target audience clearly</li>
          <li><i class="lni-check-mark-circle"></i> Choose the right venue and date</li>
          <li><i class="lni-check-mark-circle"></i> Set up proper event marketing</li>
          <li><i class="lni-check-mark-circle"></i> Engage with your attendees</li>
          <li><i class="lni-check-mark-circle"></i> Collect and act on feedback</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
<!-- Event Guidelines Section End -->

    <!-- Blog Section Start -->
    <section id="blog" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-title-header text-center">
          <h1 class="section-title wow fadeInUp" data-wow-delay="0.2s">Latest Event News & Tips</h1>
          <p class="wow fadeInDown" data-wow-delay="0.2s">Stay Updated with Event Planning Insights</p>
            </div>
          </div>
              </div>
    <div class="row">
      @foreach($latestPosts as $post)
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="blog-item">
              <div class="blog-image">
            <a href="{{ route('blog.show', $post->slug) }}">
              <img class="img-fluid" src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                </a>
              </div>
              <div class="descr">
            <div class="tag">{{ $post->category }}</div>
                <h3 class="title">
              <a href="{{ route('blog.show', $post->slug) }}">
                {{ $post->title }}
                  </a>
                </h3>
                <div class="meta-tags">
              <span class="date">{{ $post->created_at->format('M d, Y') }}</span>
              <span class="comments">| <a href="#"> by {{ $post->author }}</a></span>
                </div>
              </div>
            </div>
          </div>
      @endforeach
          </div>
          <div class="col-12 text-center">
      <a href="{{ route('blog.index') }}" class="btn btn-common">Read More Articles</a>
        </div>
      </div>
    </section>
    <!-- Blog Section End -->

@endsection
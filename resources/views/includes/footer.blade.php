<!-- Footer Section Start -->
<footer class="footer-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay="0.2s">
                <h3><img src="assets/img/logo.png" alt=""></h3>
                <p>
                    Discover and participate in the best events. Our platform connects you to experiences that matter.
                </p>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay="0.4s">
                <h3>QUICK LINKS</h3>
                <ul>
                    <li><a href="{{ route('events.featured') }}">Featured Events</a></li>
                    <li><a href="{{ route('events.schedules') }}">Event Schedule</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ route('gallery.index') }}">Photo Gallery</a></li>
                </ul>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay="0.6s">
                <h3>RECENT EVENTS</h3>
                <ul class="recent-events">
                    @foreach(\App\Models\Event::latest()->take(2)->get() as $event)
                        <li>
                            <div class="event-item">
                                <div class="event-image">
                                    @if($event->image)
                                        <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="img-fluid">
                                    @else
                                        <img src="{{ asset('images/default-event.svg') }}" alt="Default Event Image" class="img-fluid">
                                    @endif
                                </div>
                                <div class="event-info">
                                    <h6><a href="{{ route('events.show', $event) }}">{{ Str::limit($event->title, 30) }}</a></h6>
                                    <span class="date">{{ $event->start_date->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay="0.8s">
                <h3>NEWSLETTER</h3>
                <div class="widget">
                    <div class="newsletter-wrapper">
                        <form method="post" action="{{ route('newsletter.subscribe') }}" id="subscribe-form" name="subscribe-form" class="validate">
                            @csrf
                            <div class="form-group is-empty">
                                <input type="email" value="" name="email" class="form-control" id="EMAIL" 
                                       placeholder="Your email" required="">
                                <button type="submit" name="subscribe" id="subscribes" class="btn btn-common sub-btn">
                                    <i class="lni-pointer"></i>
                                </button>
                                <div class="clearfix"></div>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="widget">
                    <h5 class="widget-title">FOLLOW US</h5>
                    <ul class="footer-social">
                        <li><a class="facebook" href="#"><i class="lni-facebook-filled"></i></a></li>
                        <li><a class="twitter" href="#"><i class="lni-twitter-filled"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="lni-linkedin-filled"></i></a></li>
                        <li><a class="instagram" href="#"><i class="lni-instagram-filled"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<div id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="site-info text-center">
                    <p>© Design and Developed @mae</p>
                </div>      
            </div>
        </div>
    </div>
</div>

<!-- Go to Top Link -->
<a href="#" class="back-to-top">
    <i class="lni-chevron-up"></i>
</a>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('assets/js/jquery-min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.nav.js')}}"></script>
<script src="{{asset('assets/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('assets/js/wow.js')}}"></script>
<script src="{{asset('assets/js/jquery.slicknav.js')}}"></script>
<script src="{{asset('assets/js/nivo-lightbox.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>

<style>
.recent-events {
    list-style: none;
    padding: 0;
    margin: 0;
}

.recent-events li {
    margin-bottom: 15px;
}

.event-item {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.1);
    padding: 10px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.event-item:hover {
    background: rgba(255, 255, 255, 0.2);
}

.event-image {
    width: 60px;
    height: 60px;
    margin-right: 15px;
    border-radius: 5px;
    overflow: hidden;
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.event-info {
    flex: 1;
}

.event-info h6 {
    margin: 0 0 5px 0;
    font-size: 14px;
}

.event-info h6 a {
    color: #fff;
    text-decoration: none;
    transition: color 0.3s ease;
}

.event-info h6 a:hover {
    color: #E91E63;
}

.event-info .date {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.7);
}
</style>
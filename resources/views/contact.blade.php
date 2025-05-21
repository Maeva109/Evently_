@extends('layout')

@section('title', 'Contact Us')

@section('content')
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section-title-header text-center">
                    <h2 class="section-title">Get in Touch</h2>
                    <p>Have questions? We'd love to hear from you.</p>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                       id="subject" name="subject" value="{{ old('subject') }}" required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="message">Message</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                          id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-common">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-lg-8 col-md-10">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="contact-info">
                            <i class="lni-map-marker"></i>
                            <h4>Location</h4>
                            <p>123 Event Street</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="contact-info">
                            <i class="lni-envelope"></i>
                            <h4>Email</h4>
                            <p>info@evently.com</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="contact-info">
                            <i class="lni-phone"></i>
                            <h4>Phone</h4>
                            <p>+1 234 567 8900</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.contact-info {
    padding: 30px;
    background: #fff;
    border-radius: 4px;
    margin-bottom: 30px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.contact-info i {
    font-size: 30px;
    color: #E91E63;
    margin-bottom: 10px;
}

.contact-info h4 {
    font-size: 18px;
    margin-bottom: 10px;
}

.contact-info p {
    margin-bottom: 0;
    color: #666;
}
</style>
@endsection 
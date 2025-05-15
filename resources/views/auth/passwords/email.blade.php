@extends('layout')
@section('title', 'Reset Password - Evently')

@section('content')
<div class="reset-page">
    <div class="reset-section">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-md-5">
                    <div class="reset-wrapper">
                        <div class="brand-logo text-center mb-4">
                            <h1 class="brand-text">Event<span>ly</span></h1>
                        </div>
                        
                        <div class="reset-header text-center mb-4">
                            <h2 class="welcome-text">Reset Password</h2>
                            <p class="text-muted">Enter your email to receive a password reset link</p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success mb-4" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="reset-form">
                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf
                                
                                <div class="form-group mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="email" id="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email') }}" 
                                               placeholder="Enter your email address" required autofocus>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">
                                    Send Password Reset Link
                                </button>

                                <div class="text-center">
                                    <p class="mb-0">Remember your password? <a href="{{ route('login') }}" class="text-primary">Sign In</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .reset-page {
        min-height: 100vh;
        background: linear-gradient(135deg, rgba(233, 30, 99, 0.05) 0%, rgba(233, 30, 99, 0.1) 100%);
    }

    .reset-section {
        padding: 2rem 0;
        width: 100%;
    }

    .reset-wrapper {
        background: #fff;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin: 1rem auto;
    }

    .brand-logo {
        margin-bottom: 2rem;
    }

    .brand-text {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin: 0;
    }

    .brand-text span {
        color: #E91E63;
    }

    .welcome-text {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-label {
        font-weight: 500;
        color: #555;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .input-group {
        border-radius: 8px;
        overflow: hidden;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        color: #E91E63;
        border-right: none;
    }

    .form-control {
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
        height: auto;
        font-size: 0.95rem;
        border-left: none;
    }

    .form-control:focus {
        border-color: #E91E63;
        box-shadow: none;
    }

    .btn-primary {
        background-color: #E91E63;
        border-color: #E91E63;
        padding: 12px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 8px;
        font-size: 1rem;
    }

    .btn-primary:hover {
        background-color: #C2185B;
        border-color: #C2185B;
        transform: translateY(-1px);
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 4px;
    }

    .alert {
        border-radius: 8px;
        padding: 1rem;
    }
</style>
@endpush
@endsection 
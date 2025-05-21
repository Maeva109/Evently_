@extends('layout')
@section('title', 'Sign Up - Evently')

@section('content')
<div class="signup-page">
    <div class="signup-section">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-md-5">
                    <div class="signup-wrapper">
                        <div class="brand-logo text-center mb-4">
                            <h1 class="brand-text">Event<span>ly</span></h1>
                        </div>
                        
                        <div class="signup-header text-center mb-4">
                            <h2 class="welcome-text">Create Account</h2>
                            <p class="text-muted">Join us and start exploring amazing events</p>
                        </div>

                        <div class="signup-form">
                            <form action="/register" method="POST">
                                @csrf
                                
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" name="name" id="name" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name') }}" 
                                               placeholder="Enter your full name" required>
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="email" id="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email') }}" 
                                               placeholder="Enter your email address" required>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" name="password" id="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               placeholder="Choose a password" required>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" name="password_confirmation" id="password_confirmation" 
                                               class="form-control @error('password_confirmation') is-invalid @enderror" 
                                               placeholder="Confirm your password" required>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="role" class="form-label">I want to</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                        <select name="role" id="role" class="form-select" required>
                                            <option value="participant" selected>Attend Events</option>
                                            <option value="moderator">Organize Events</option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="status" value="active">
                                
                                <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">
                                    Create Account
                                </button>

                                <div class="text-center">
                                    <p class="mb-0">Already have an account? <a href="/login" class="text-primary">Log In</a></p>
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
    .signup-page {
        min-height: 100vh;
        background: linear-gradient(135deg, rgba(233, 30, 99, 0.05) 0%, rgba(233, 30, 99, 0.1) 100%);
    }

    .signup-section {
        padding: 2rem 0;
        width: 100%;
    }

    .signup-wrapper {
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

    .form-control, .form-select {
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
        height: auto;
        font-size: 0.95rem;
        border-left: none;
    }

    .form-control:focus, .form-select:focus {
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

    a {
        color: #E91E63;
        text-decoration: none;
        transition: color 0.3s ease;
        font-weight: 500;
    }

    a:hover {
        color: #C2185B;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .signup-wrapper {
            padding: 1.5rem;
            margin: 1rem;
        }

        .welcome-text {
            font-size: 1.25rem;
        }
    }

    /* Custom input styling */
    .form-control::placeholder {
        color: #adb5bd;
        opacity: 0.8;
    }

    .form-control:focus::placeholder {
        opacity: 0.6;
    }

    .input-group:focus-within {
        box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.25);
        border-radius: 8px;
    }

    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control {
        border-color: #E91E63;
    }
</style>
@endpush
@endsection
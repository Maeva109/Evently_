{{-- @extends('layout')
@section('title','Contact')

@section('content') --}}
<div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
    <br />
    <br />
    <h2 class="text-2xl font-bold mb-6 text-center">Contactez-nous</h2>

    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded-md mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="/sendmessage" method="POST" class="p-4 bg-light shadow rounded">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Nom</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
    
        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email" class="form-control" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
    
        <div class="mb-3">
            <label class="form-label fw-bold">Sujet</label>
            <input type="text" name="subject" class="form-control" required>
            @error('subject') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
    
        <div class="mb-3">
            <label class="form-label fw-bold">Message</label>
            <textarea name="message" rows="5" class="form-control" required></textarea>
            @error('message') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
    
        <button type="submit" class="btn btn-primary w-100">Envoyer</button>
    </form>
</div>
{{-- @endsection --}}

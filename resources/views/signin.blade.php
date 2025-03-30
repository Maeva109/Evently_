@extends('layout')
@section('title','Sign')

@section('content')
  <!-- Main Carousel Section End -->

</header>
<!-- Header Area wrapper End -->
    <div class="container">
      <div class="row justify-content-center mt-4">
        <div class="col-md-8">
          <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
              <h3 class="mb-0">Inscription</h3>
            </div>
            <div class="card-body">
              <form action="/register" method="POST">
                @csrf
                <!-- Nom -->
                <div class="form-group">
                  <label for="name">Nom complet</label>
                  <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"  placeholder="Entrez votre nom complet" required>
                  @error('name')
                        <span class="text-danger" style="color: red">{{ $message }}</span>
                            
                  @enderror
                </div>
                <!-- Email -->
                <div class="form-group">
                  <label for="email">Adresse Email</label>
                  <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"  placeholder="Entrez votre adresse email" required>
                  @error('email')
                        <span class="text-danger" style="color: red">{{ $message }}</span>
                            
                        @enderror
                </div>
                <!-- Mot de passe -->
                <div class="form-group">
                  <label for="password">Mot de passe</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Choisissez un mot de passe" required>
                  @error('password')
                        <span class="text-danger" style="color: red">{{ $message }}</span>
                            
                        @enderror
                </div>
                <!-- Confirmation du mot de passe -->
                <div class="form-group">
                  <label for="password_confirmation">Confirmez le mot de passe</label>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmez votre mot de passe" required>
                  @error('password_confirmation')
                        <span class="text-danger" style="color: red">{{ $message }}</span>
                            
                        @enderror
                </div>
                <!-- Sélection du rôle (optionnel, par exemple pour choisir entre Moderator et Participant) -->
                <div class="form-group">
                  <label for="role">Choisissez votre rôle</label>
                  <select name="role" id="role" class="form-control" required>
                    <option value="participant" selected>Participant</option>
                    <option value="moderator">Modérateur</option>
                  </select>
                </div>
                <!-- Statut caché ou par défaut -->
                <input type="hidden" name="status" value="active">
                
                <!-- Bouton d'inscription -->
                <div class="form-group mt-4">
                  <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
                </div>
              </form>
              <div class="text-center">
                <a href="/signup">Connectez vous !</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  

@endsection
@extends('layout')

@section('content')
  <!-- Main Carousel Section End -->

</header>
<!-- Header Area wrapper End -->

    <div class="container">
      <div class="row justify-content-center  mt-4">
        <div class="col-md-6">
          <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
              <h3 class="mb-0">Connexion</h3>
            </div>
            <div class="card-body">
              <form action="/login" method="POST">
                @csrf
                <!-- Email -->
                <div class="form-group">
                  <label for="login_email">Adresse Email</label>
                  <input type="email" name="email" id="login_email" class="form-control" value="{{ old('email') }}" placeholder="Entrez votre adresse email" required>
                  @error('email')
                        <span class="text-danger" style="color: red">{{ $message }}</span>
                            
                        @enderror
                </div>
                <!-- Mot de passe -->
                <div class="form-group">
                  <label for="login_password">Mot de passe</label>
                  <input type="password" name="password" id="login_password" class="form-control"  placeholder="Entrez votre mot de passe" required>
                  @error('password')
                        <span class="text-danger" style="color: red">{{ $message }}</span>
                            
                        @enderror
                </div>
                <!-- Remember me -->
                <div class="form-group form-check">
                  <input type="checkbox" name="remember" id="remember" class="form-check-input" >
                  <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>
                
                <div class="form-group mt-4">
                  <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                </div>
              </form>
              <div class="text-center">
                <a href="/signin">Inscrivez vous plutot !</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
@endsection
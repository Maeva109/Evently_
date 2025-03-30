<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Ramsey\Uuid\v1;

class UserController extends Controller
{
    //
  
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->rememberme)) {
        $request->session()->regenerate();

        // Vérifier le rôle de l'utilisateur connecté
        if (Auth::user()->role === 'participant') {
            return redirect('/')->with('success', "Connexion réussie");
        } elseif (Auth::user()->role === 'moderator') {
            return redirect('/admin')->with('success', "Connexion réussie");
        } elseif(Auth::user()->role === 'admin'){
            return redirect('/admin')->with('success', "Connexion réussie");
        }else {
            // Pour les autres rôles, rediriger vers la page d'accueil par défaut
            return redirect('/')->with('success', "Connexion réussie");
        }
    }

    return back()->withErrors([
        'email' => 'Les informations fournies ne correspondent pas à nos enregistrements.',
    ])->onlyInput('email');
}

    public function register(Request $request)
{
    $validated = $request->validate([
        'name'     => 'required|string|min:6|max:255',
        'email'    => 'required|email|string|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role'     => 'required|in:moderator,participant',
        'status'   => 'required|in:active,inactive',
    ]);

    // Hacher le mot de passe avant de l'enregistrer
    $validated['password'] = Hash::make($validated['password']);

    User::create($validated);


    return redirect('/')
           ->with("success", "L'utilisateur " . $request->name . " a été créé avec succès");
}
    public function signin(){
        // login code here
        return view('signin');
        
    }
    public function signup(){
        // singup code here
        return view('login');
        
    }
    public function logout(Request $request)
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
}
}

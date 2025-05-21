<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function register()
    {
        return view('organizer.register');
    }

    public function dashboard()
    {
        return view('organizer.dashboard');
    }

    public function profile(User $organizer)
    {
        return view('organizer.profile', compact('organizer'));
    }

    public function index()
    {
        $organizers = User::whereHas('events')->paginate(12);
        return view('organizer.index', compact('organizers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required|accepted'
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->description = $validated['description'];
        $user->password = bcrypt($validated['password']);
        $user->role = 'organizer';

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->move(public_path('images/organizers'), $logoName);
            $user->logo = 'images/organizers/' . $logoName;
        }

        $user->save();

        auth()->login($user);

        return redirect()->route('organizer.dashboard')
            ->with('success', 'Registration successful! Welcome to your dashboard.');
    }
} 
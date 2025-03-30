<?php

namespace App\Http\Controllers;

use App\Jobs\processContact;
use App\Models\Contact;
use App\Notifications\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    //
    public function showForm()
    {
        return view('contact');
    }

    public function sendMessage(Request $request)
    {
        // Validation des champs
        $valited = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);
        // sauvergarder mon contact
        $contact = Contact::create($valited);
        // La notification a envoyer 
        processContact::dispatch($contact);
        // Notification::send($contact , new SendMessage($contact));

        return back()->with('success', 'Votre message a été envoyé avec succès.');
        
    }
}

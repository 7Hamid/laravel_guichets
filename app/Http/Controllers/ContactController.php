<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //create function
    public function create(Request $request)
    {
        $ticketId = $request->query('ticket_id');
        $ticket = null;
        if ($ticketId) {
            $ticket = Ticket::find($ticketId);
        }
        return view('contact.create', compact('ticket'));
    }

    //store function
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'promo_code' => 'required|string|max:255',
            'ticket' => 'required|exists:tickets,id',
        ]);
        $validatedData['ticket_choisi'] = $validatedData['ticket'];
        Contact::create($validatedData);
        return redirect()->route('contact.create')->with('success', 'Votre demande a été envoyée avec succès.');
    }
}

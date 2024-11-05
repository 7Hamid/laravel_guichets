<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProgrammableTicket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProgrammableTicketController extends Controller
{
    public function index(Request $request)
    {

        // Get the current date and time or the values provided by the user
        $date = $request->input('date', Carbon::now()->format('Y-m-d'));
        $time = $request->input('time', Carbon::now()->format('H:i'));

        // Parse the provided date and time for comparison
        $dateObject = Carbon::parse($date);
        $timeObject = Carbon::parse($time);

        // Retrieve tickets where both scheduled date and time match or have passed
        $tickets = ProgrammableTicket::whereDate('scheduled_date', '>=', $dateObject)
            ->whereTime('scheduled_time', '>=', $timeObject)
            ->get();

        return view('programmableTickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('programmableTickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'adresse' => 'required|string',
            'localisation' => 'required|string',
            'categorie' => 'required|string',
            'phone' => 'required|string',
            'prix' => 'required|numeric',
            'prix_vip' => 'nullable|numeric',
            'devise' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        ProgrammableTicket::create($data);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show($id)
    {
        // Retrieve the ticket details by its ID
        $ticket = ProgrammableTicket::findOrFail($id);

        return view('programmableTickets.show', compact('ticket'));
    }
}

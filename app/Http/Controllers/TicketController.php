<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProgrammableTicket;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    //index function
    public function index(Request $request)
    {
        $ticketsQuery = Ticket::query();
        $name = $request->input('search');
        if (!empty($name)) {
            $ticketsQuery->where('title', 'like', "%{$name}%");
        }
        $tickets = $ticketsQuery->get();
        return view('tickets.index', compact('tickets'));
    }


    //create function
    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }


    //store function
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'adresse' => 'required|string',
            'localisation' => 'required|string',
            'categorie' => 'required|string',
            'prix' => 'required|numeric',
            'prix_vip' => 'required|numeric',
            'phone' => 'required|numeric',
            'devise' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'event_date' => 'nullable|date',
            'event_time' => 'nullable|date_format:H:i',
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $path;
        }
        Ticket::create($validatedData);
        return redirect()->route('tickets.index')->with('success', 'Ticket créé avec succès.');
    }

    //show function
    public function show(Ticket $ticket)
    {
        $relatedTickets = Ticket::where('categorie', $ticket->categorie)
            ->where('id', '!=', $ticket->id)
            ->get();

        return view('tickets.show', compact('ticket', 'relatedTickets'));
    }

    //filter by categorie
    public function filterByCategory($category)
    {
        $tickets = Ticket::where('categorie', $category)->get();
        $programmableTickets = ProgrammableTicket::where('categorie', $category)->get();
        //dd($programmableTickets);
        $categories = Category::all(); // Fetch all categories for the navbar


        return view('tickets.showTickets', compact('tickets', 'categories', 'programmableTickets'));
    }



    //showTickets
    public function showTickets(Request $request)
    {
        $ticketsQuery = Ticket::query();
        $programmableTicketsQuery = ProgrammableTicket::query();

        $categories = Category::all();
        $name = $request->input('title');
        $selectedCategories = $request->input('categories', []);
        $now = now();

        if (!empty($name)) {
            $ticketsQuery->where('title', 'like', "%{$name}%");
        }

        if (!empty($selectedCategories)) {
            $ticketsQuery->whereIn('categorie', $selectedCategories);
            $programmableTicketsQuery->whereIn('categorie', $selectedCategories);
        }

        // Filter tickets where the event date/time has not yet passed
        $ticketsQuery->where(function ($query) use ($now) {
            $query->whereDate('event_date', '>', $now->toDateString())
                ->orWhere(function ($subQuery) use ($now) {
                    $subQuery->whereDate('event_date', '=', $now->toDateString())
                        ->whereTime('event_time', '>', $now->toTimeString());
                });
        });

        $programmableTicketsQuery->where(function ($query) use ($now) {
            $query->whereDate('event_date', '>', $now->toDateString())
                ->orWhere(function ($subQuery) use ($now) {
                    $subQuery->whereDate('event_date', '=', $now->toDateString())
                        ->whereTime('event_time', '>', $now->toTimeString());
                });
        });

        $tickets = $ticketsQuery->get();
        $programmableTickets = $programmableTicketsQuery->get();

        return view('tickets.showTickets', compact('tickets', 'categories', 'programmableTickets'));
    }


    //display closed tickets
    public function closedTickets()
    {
        $now = now();
        $tickets = Ticket::where(function ($query) use ($now) {
            $query->whereDate('event_date', '<', $now->toDateString())
                ->orWhere(function ($subQuery) use ($now) {
                    $subQuery->whereDate('event_date', '=', $now->toDateString())
                        ->whereTime('event_time', '<', $now->toTimeString());
                });
        })->get();
        return view('tickets.closedTickets', compact('tickets'));
    }


    //edit function
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $categories = Category::all();
        return view('tickets.edit', compact('ticket', 'categories'));
    }

    //update function
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'adresse' => 'required|string',
            'localisation' => 'required|string',
            'categorie' => 'required|string',
            'prix' => 'required|numeric',
            'prix_vip' => 'required|numeric',
            'phone' => 'required|numeric',
            'devise' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'event_date' => 'nullable|date',
            'event_time' => 'nullable',
        ]);
        $ticketData = $request->all();
        if ($request->hasFile('image')) {
            if ($ticket->image && Storage::disk('public')->exists($ticket->image)) {
                Storage::disk('public')->delete($ticket->image);
            }
            $ticketData['image'] = $request->file('image')->store('images', 'public');
        }
        $ticket->update($ticketData);
        return redirect()->route('tickets.index')
            ->with('success', 'Ticket updated successfully.');
    }

    //destroy function
    public function destroy(Ticket $ticket)
    {
        if ($ticket->image && Storage::disk('public')->exists($ticket->image)) {
            Storage::disk('public')->delete($ticket->image);
        }
        $ticket->delete();
        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }
}

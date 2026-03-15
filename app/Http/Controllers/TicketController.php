<?php

namespace App\Http\Controllers;

use App\Models\Projecte;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Projecte $projecte)
    {
        $tickets = $projecte->tickets()->latest()->get();
        return view('tickets.index', compact('projecte', 'tickets'));
    }

    public function create(Projecte $projecte)
    {
        return view('tickets.create', compact('projecte'));
    }

    public function store(Request $request, Projecte $projecte)
    {
        $ticket = Ticket::create([
            'projecte_id' => $projecte->id,
            'creador_id' => auth()->id(), // usuario logueado
            'codi_ticket' => 'TICKET-' . time(), // simple unique
            'titol' => $request->titol,
            'descripcio' => $request->descripcio,
            'estat' => 'NOU',
        ]);

        return redirect()->route('tickets.show', [$projecte, $ticket])
            ->with('success', 'Ticket creat');
    }

    public function show(Projecte $projecte, Ticket $ticket)
    {
        $comentaris = $ticket->comentaris()->latest()->get();
        return view('tickets.show', compact('projecte', 'ticket', 'comentaris'));
    }

    public function edit(Projecte $projecte, Ticket $ticket)
    {
        return view('tickets.edit', compact('projecte', 'ticket'));
    }

    public function update(Request $request, Projecte $projecte, Ticket $ticket)
    {
        $ticket->update([
            'titol' => $request->titol,
            'descripcio' => $request->descripcio,
            'estat' => $request->estat ?? $ticket->estat,
        ]);

        return redirect()->route('tickets.show', [$projecte, $ticket])
            ->with('success', 'Ticket actualitzat');
    }
}

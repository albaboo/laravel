<?php

namespace App\Http\Controllers;

use App\Models\Projecte;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController
{
    public function index(Projecte $projecte)
    {
        $this->authorize('view', $projecte);
        $this->authorize('viewAny', Projecte::class);
        $tickets = $projecte->tickets()->latest()->get();
        return view('tickets.index', compact('projecte', 'tickets'));
    }

    public function create(Projecte $projecte)
    {
        $this->authorize('view', $projecte);
        $this->authorize('create', Ticket::class);
        return view('tickets.create', compact('projecte'));
    }

    public function store(Request $request, Projecte $projecte)
    {
        $this->authorize('view', $projecte);
        $this->authorize('create', Ticket::class);

        if (!$projecte->usuaris->contains('id', Auth::id()))
            abort(403);

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
        $this->authorize('view', $projecte);
        $this->authorize('view', $ticket);
        if ($ticket->estat === 'ASSIGNAT' && Auth::id() !== $ticket->creador_id)
            abort(403);

        $comentaris = $ticket->comentaris()->latest()->get();
        $ticket->load(['registreTemps', 'registreTemps.user']);
        return view('tickets.show', compact('projecte', 'ticket', 'comentaris'));
    }

    public function edit(Projecte $projecte, Ticket $ticket)
    {
        $this->authorize('view', $projecte);
        $this->authorize('update', $ticket);
        return view('tickets.edit', compact('projecte', 'ticket'));
    }

    public function update(Request $request, Projecte $projecte, Ticket $ticket)
    {
        $this->authorize('view', $projecte);
        $this->authorize('update', $ticket);
        if ($request->estat == 'TANCAT' && $ticket->fills()->where('estat', '!=', 'TANCAT')->exists())
            return back()->withErrors('No pots tancar el ticket amb fills oberts');

        $ticket->update([
            'titol' => $request->titol,
            'descripcio' => $request->descripcio,
            'estat' => $request->estat ?? $ticket->estat,
        ]);

        return redirect()->route('tickets.show', [$projecte, $ticket])
            ->with('success', 'Ticket actualitzat');
    }

    public function canviarEstat(Request $request, Projecte $projecte, Ticket $ticket) {
        $transicions = [
            'NOU' => ['ASSIGNAT'],
            'ASSIGNAT' => ['EN_PROGRES'],
            'EN_PROGRES' => ['EN_REVISIO'],
            'EN_REVISIO' => ['TANCAT']
        ];

        if (!in_array($request->estat, $transicions[$ticket->estat]))
            return back()->withErrors('Transició no permesa');

        if ($request->estat == 'TANCAT' && $ticket->fills()->where('estat', '!=', 'TANCAT')->exists())
            return back()->withErrors('No pots tancar el ticket amb fills oberts');

    }
}

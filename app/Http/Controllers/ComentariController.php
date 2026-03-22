<?php

namespace App\Http\Controllers;

use App\Models\Comentari;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentariController
{
    public function store(Request $request, Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        $this->authorize('create', Comentari::class);
        $request->validate(['text' => 'required|string|max:1000']);
        Comentari::create([
            'ticket_id' => $ticket->id,
            'autor_id' => Auth::id(),
            'text' => $request->text,
        ]);

        return redirect()->route('tickets.show', [
            'projecte' => $ticket->projecte()->first()->id,
            'ticket' => $ticket->id,
        ])->with('success', 'Comentari afegit');
    }

    public function destroy(Comentari $comentari)
    {
        $this->authorize('delete', $comentari);

        $ticket = $comentari->ticket()->first();
        $comentari->delete();

        return redirect()->route('tickets.show', [
            'projecte' => $ticket->projecte()->first()->id,
            'ticket' => $ticket->id,
        ])->with('success', 'Comentari eliminat');
    }
}

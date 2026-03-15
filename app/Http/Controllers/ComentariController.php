<?php

namespace App\Http\Controllers;

use App\Models\Comentari;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentariController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        Comentari::create([
            'ticket_id' => $ticket->id,
            'autor_id'  => Auth::id(),
            'text'      => $request->text,
        ]);

        return redirect()->route('tickets.show', $ticket)->with('success', 'Comentari afegit');
    }

    public function destroy(Comentari $comentari)
    {
        $ticket = $comentari->ticket;
        $comentari->delete();

        return redirect()->route('tickets.show', $ticket)->with('success', 'Comentari eliminat');
    }
}

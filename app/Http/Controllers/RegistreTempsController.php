<?php

namespace App\Http\Controllers;

use App\Models\RegistreTemps;
use App\Models\Ticket;
use Auth;
use Illuminate\Http\Request;

class RegistreTempsController extends Controller
{

    public function create(Ticket $ticket)
    {
        return view('temps.create', compact('ticket'));
    }

    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'data' => ['required', 'date', 'before_or_equal:today'],
            'hores' => ['required', 'numeric', 'min:0.01', 'max:12'],
            'descripcio' => ['required', 'string']
        ]);

        if ($ticket->creador_id !== Auth::id())
            abort(403);

        if (in_array($ticket->estat, ['NOU', 'TANCAT']))
            return back()->withErrors('No es pot registrar temps en aquest estat');

        RegistreTemps::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'data' => $request->data,
            'hores' => $request->hores,
            'descripcio' => $request->descripcio
        ]);

        return redirect()->route('tickets.show', $ticket)->with('success', 'Temps registrat correctament');
    }
}

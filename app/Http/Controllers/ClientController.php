<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController
{
    public function index()
    {
        $this->authorize('viewAny', Client::class);
        $clients = Client::where('actiu', true)->get();
        return view('clients.index', ['clients' => $clients]);
    }

    public function create()
    {
        $this->authorize('create');
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create');
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cif' => 'required|string|max:50|unique:clients,cif',
            'email_contacte' => 'nullable|email|max:255',
            'telefon' => 'nullable|string|max:50',
            'direccio' => 'nullable|string|max:255',
            'actiu' => 'nullable|boolean',
        ]);
        $client = Client::create([
            'nombre' => $request->nombre,
            'cif' => $request->cif,
            'email_contacte' => $request->email_contacte,
            'telefon' => $request->telefon,
            'direccio' => $request->direccio,
            'actiu' => $request->has('actiu') ?? false
        ]);

        return redirect()->route('clients.index')->with('success', 'Client creat correctament');
    }

    public function show(Client $client)
    {
        $this->authorize('view', $client);
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        $this->authorize('update', $client);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cif' => 'required|string|max:50|unique:clients,cif,' . $client->id,
            'email_contacte' => 'nullable|email|max:255',
            'telefon' => 'nullable|string|max:50',
            'direccio' => 'nullable|string|max:255',
            'actiu' => 'nullable|boolean',
        ]);

        $client->update([
            'nombre' => $request->nombre,
            'cif' => $request->cif,
            'email_contacte' => $request->email_contacte,
            'telefon' => $request->telefon,
            'direccio' => $request->direccio,
            'actiu' => $request->has('actiu') ?? false,
        ]);

        return redirect()->route('clients.index')->with('success', 'Client actualitzat correctament.');
    }

    public function projectes(Client $client)
    {
        $this->authorize('view', $client);
        $projectes = $client->projectes()->with('gestor')->get();

        return view('clients.projectes', compact('client', 'projectes'));
    }

}

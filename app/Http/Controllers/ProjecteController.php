<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ConfiguracioProjecte;
use App\Models\Projecte;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ProjecteController
{
    public function index()
    {
        $this->authorize('viewAny', Projecte::class);
        $user = auth()->user();
        $projectes = match ($user->rol) {
            Role::ADMIN, Role::GESTOR => Projecte::query(),
            Role::CLIENT => Projecte::where('client_id', $user->client()->id),
            Role::DEVELOPER => Projecte::whereHas('usuaris', fn($q) => $q->where('user_id', $user->id)),
        };

        return view('projectes.index', ['projectes' => $projectes->get()]);
    }

    public function create()
    {
        $this->authorize('create', Projecte::class);
        $clients = Client::where('actiu', true)->orderBy('nombre')->get();
        return view('projectes.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Projecte::class);
        $request->validate([
            'client_id' => [
                'required',
                'exists:clients,id',
                function ($attribute, $value, $fail) {
                    $client = Client::find($value);
                    if (!$client || !$client->actiu) {
                        $fail('El clients no existeix o no està actiu.');
                    }
                }
            ],
            'nom' => 'required|string|max:255',
            'pressupost_hores_estimades' => 'required|integer|min:1',
            'data_inici' => 'nullable|date',
            'data_fi_prevista' => 'nullable|date|after_or_equal:data_inici',
            'descripcio' => 'nullable|string',
        ]);

        $projecte = Projecte::create([
            'client_id' => $request->client_id,
            'gestor_id' => Auth::id(),

            'nom' => $request->nom,
            'descripcio' => $request->descripcio,

            'estat' => 'PLANIFICACIO',

            'data_inici' => $request->data_inici,
            'data_fi_prevista' => $request->data_fi_prevista,

            'pressupost_hores_estimades' => $request->pressupost_hores_estimades,
            'pressupost_hores_reals' => 0,
            'codi_projecte' => ''
        ]);

        $any = date('Y');
        $codi = 'PROJ-' . $any . '-' . $projecte->id;

        $projecte->update(['codi_projecte' => $codi]);
        $projecte->usuaris()->attach(Auth::id());

        ConfiguracioProjecte::create([
            'projecte_id' => $projecte->id,
            'plantilla_correus' => 'FORNAL',
            'notificacions_actives' => false,
            'workflow_personalitzat' => '',
            'requereix_aprovacio_client' => false,
        ]);

        return redirect()->route('projectes.show', $projecte)->with('success', 'Projecte creat correctament');
    }

    public function show(Projecte $projecte)
    {
        $this->authorize('view', $projecte);
        $projecte->load(['client', 'gestor']);
        return view('projectes.show', compact('projecte'));
    }

    public function edit(Projecte $projecte)
    {
        $this->authorize('update', $projecte);
        $projecte->load(['client', 'gestor']);
        return view('projectes.edit', compact('projecte'));
    }

    public function update(Request $request, Projecte $projecte)
    {
        $this->authorize('update', $projecte);
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'estat' => 'required|in:PLANIFICACIO,EN_CURS,PAUSAT,FINALIZAT,CANCELAT',
            'data_inici' => 'nullable|date',
            'data_fi_prevista' => 'nullable|date|after_or_equal:data_inici',
            'pressupost_hores_estimades' => 'required|integer|min:1',
        ]);

        $projecte->update([
            'nom' => $request->nom,
            'descripcio' => $request->descripcio,
            'estat' => $request->estat,
            'data_inici' => $request->data_inici,
            'data_fi_prevista' => $request->data_fi_prevista,
            'pressupost_hores_estimades' => $request->pressupost_hores_estimades,
        ]);

        return redirect()->route('projectes.show', $projecte)->with('success', 'Projecte actualitzat correctament');
    }

    public function canviarEstat(Request $request, Projecte $projecte)
    {
        $this->authorize('update', $projecte);
        $request->validate([
            'estat' => 'required|in:PLANIFICACIO,EN_CURS,PAUSAT,FINALIZAT,CANCELAT'
        ]);

        $estatActual = $projecte->estat;
        $nouEstat = $request->estat;
        $transicionsValides = [
            'PLANIFICACIO' => ['EN_CURS', 'CANCELAT'],
            'EN_CURS' => ['PAUSAT', 'FINALIZAT', 'CANCELAT'],
            'PAUSAT' => ['EN_CURS', 'CANCELAT'],
            'FINALIZAT' => [],
            'CANCELAT' => []
        ];

        if (!in_array($nouEstat, $transicionsValides[$estatActual]))
            return redirect()->route('projectes.show', $projecte)->with('error', "Transició no permesa de $estatActual a $nouEstat");

        if ($estatActual === 'PLANIFICACIO' && $nouEstat === 'EN_CURS')
            if (!$projecte->data_inici)
                $projecte->data_inici = Carbon::now();

        if ($estatActual === 'EN_CURS' && $nouEstat === 'FINALIZAT')
            $projecte->data_fi_real = Carbon::now();

        $projecte->estat = $nouEstat;
        $projecte->save();
        return redirect()->route('projectes.show', $projecte)->with('success', "Estat canviat a $nouEstat correctament");
    }
}

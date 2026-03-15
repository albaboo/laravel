@extends('layouts.app')
@section('content')
    <div style="padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
        <div style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <h1>Detalls del projecte</h1>
            <h2>{{ $projecte->codi_projecte }} - {{ $projecte->nom }}</h2>
            <p><b>Descripció:</b><br>
                {{ $projecte->descripcio ?? 'Sense descripció' }}
            </p>
            <hr>
            <h3>Client</h3>
            <p><b>Nom:</b> {{ $projecte->client->nombre }}</p>
            <p><b>CIF:</b> {{ $projecte->client->cif }}</p>
            <hr>
            <h3>Gestor</h3>
            <p>{{ $projecte->gestor->name }}</p>
            <hr>
            <h3>Estat</h3>
            @php
                $colors = [
                    'PLANIFICACIO' => '#6c757d', // gris
                    'EN_CURS' => '#0d6efd', // azul
                    'PAUSAT' => '#fd7e14', // naranja
                    'FINALIZAT' => '#198754', // verde
                    'CANCELAT' => '#dc3545' // rojo
                ];
            @endphp
            <span style="
            background-color: {{ $colors[$projecte->estat] }};
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 0.95em;
        ">
            {{ $projecte->estat }}
        </span>
            <hr>
            <h3>Dates</h3>
            <p><b>Data inici:</b> {{ $projecte->data_inici?->format('d/m/Y') }}</p>
            <p><b>Data fi prevista:</b> {{ $projecte->data_fi_prevista?->format('d/m/Y') }}</p>
            <p><b>Data fi real:</b> {{ $projecte->data_fi_real?->format('d/m/Y') }}</p>
            <hr>
            <h3>Canviar estat</h3>
            <form method="POST" action="{{ route('projectes.canviarEstat', $projecte) }}" style="margin-top: 10px;">
                @csrf
                @method('PATCH')
                <select name="estat" style="padding: 5px 10px; border-radius: 4px; border: 1px solid #ced4da;">
                    <option value="EN_CURS">Iniciar</option>
                    <option value="PAUSAT">Pausar</option>
                    <option value="FINALIZAT">Finalitzar</option>
                    <option value="CANCELAT">Cancel·lar</option>
                </select>
                <button type="submit" style="
                padding: 6px 12px;
                background-color: #0d6efd;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-left: 5px;
            ">
                    Canviar estat
                </button>
            </form>
        </div>

    </div>
@endsection

@extends('layouts.app')
@section('content')
    <div style="padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1 style="color: #212529;">Projectes de {{ $client->nombre }}</h1>
        </div>
        @if($projectes->count() > 0)
            <table style="
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    ">
                <thead>
                <tr style="background-color: #e9ecef; text-align: left;">
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Codi</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Nom</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Gestor</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Estat</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Accions</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $colors = [
                        'PLANIFICACIO' => '#6c757d',
                        'EN_CURS' => '#0d6efd',
                        'PAUSAT' => '#fd7e14',
                        'FINALIZAT' => '#198754',
                        'CANCELAT' => '#dc3545'
                    ];
                @endphp
                @foreach($projectes as $projecte)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 8px;">{{ $projecte->codi_projecte }}</td>
                        <td style="padding: 8px;">{{ $projecte->nom }}</td>
                        <td style="padding: 8px;">{{ $projecte->gestor->name ?? '-' }}</td>
                        <td style="padding: 8px;">
                    <span style="
                        background-color: {{ $colors[$projecte->estat] }};
                        color: white;
                        padding: 3px 8px;
                        border-radius: 4px;
                        font-size: 0.9em;
                    ">
                        {{ $projecte->estat }}
                    </span>
                        </td>
                        <td style="padding: 8px;">
                            <a href="{{ route('projectes.show', $projecte) }}" style="color:#0d6efd;">Veure</a> |
                            <a href="{{ route('projectes.edit', $projecte) }}" style="color:#0d6efd;">Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No hi ha projectes per aquest client.</p>
        @endif
    </div>
@endsection

@extends('layouts.app')
@section('content')
    <div style="padding: 20px;">
        <div style="
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background-color: white;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        ">
            <h1 style="margin:0; color: #212529;">Llista de projectes</h1>
            <a href="{{ route('projectes.create') }}" style="
                padding: 8px 16px;
                background-color: #0d6efd;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
            ">Crear projecte</a>
        </div>
        @if($projectes->count() > 0)
            <table style="
                width: 100%;
                border-collapse: collapse;
                background-color: white;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                margin-top: 15px;
            ">
                <thead>
                <tr style="background-color: #e9ecef; text-align: left;">
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Codi</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Nom</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Client</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Gestor</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Estat</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projectes as $projecte)
                    @php
                        $colors = [
                            'PLANIFICACIO' => '#6c757d',
                            'EN_CURS' => '#0d6efd',
                            'PAUSAT' => '#fd7e14',
                            'FINALIZAT' => '#198754',
                            'CANCELAT' => '#dc3545'
                        ];
                    @endphp
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 8px;">{{ $projecte->codi_projecte }}</td>
                        <td style="padding: 8px;">{{ $projecte->nom }}</td>
                        <td style="padding: 8px;">{{ $projecte->client->nombre ?? '-' }}</td>
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
            <p style="margin-top:15px;">No hi ha projectes registrats.</p>
        @endif
    </div>
@endsection

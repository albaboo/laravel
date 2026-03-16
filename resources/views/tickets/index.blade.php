@extends('layouts.app')

@section('content')
    <div style="padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
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
            <h1 style="margin:0; color: #212529;">Tickets de <b>{{ $projecte->nom }}</b></h1>

            <a href="{{ route('tickets.create', $projecte) }}" style="
            padding: 8px 16px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        ">Crear Ticket</a>

        </div>

        <table id="tickets-table" style="
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-top: 15px;">
            <thead>
            <tr style="background-color: #e9ecef; text-align: left;">
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Codi</th>
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Titol</th>
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Estat</th>
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Comentaris</th>
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Accio</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tickets as $ticket)
                @php
                    $colors = [
                        'NOU' => '#0d6efd',
                        'OBERT' => '#198754',
                        'TANCAT' => '#dc3545'
                    ];
                @endphp
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 8px;">{{ $ticket->codi_ticket }}</td>
                    <td style="padding: 8px;">{{ $ticket->titol }}</td>
                    <td style="padding: 8px;">
                                            <span style="
                            background-color: {{ $colors[$ticket->estat] }};
                            color: white;
                            padding: 3px 8px;
                            border-radius: 4px;
                            font-size: 0.9em;
                        ">
                            {{ $ticket->estat }}
                        </span>
                    </td>
                    <td style="padding: 8px;">{{ $ticket->comentaris->count() }}</td>
                    <td style="padding: 8px;">
                        <a href="{{ route('tickets.show', [$projecte, $ticket]) }}" style="color:#0d6efd;">Veure</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

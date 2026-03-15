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

            <a href="{{ route('tickets.create', $projecte) }}"  style="
            padding: 8px 16px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        ">Crear Ticket</a>

        </div>

        <ul>
            @foreach($tickets as $ticket)
                <li>
                    <a href="{{ route('tickets.show', [$projecte, $ticket]) }}">
                        {{ $ticket->codi_ticket }} - {{ $ticket->titol }} ({{ $ticket->estat }})
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

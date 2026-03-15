@extends('layouts.app')

@section('content')
    <h1>Tickets de {{ $projecte->nom }}</h1>

    <a href="{{ route('tickets.create', $projecte) }}">Crear Ticket</a>

    <ul>
        @foreach($tickets as $ticket)
            <li>
                <a href="{{ route('tickets.show', [$projecte, $ticket]) }}">
                    {{ $ticket->codi_ticket }} - {{ $ticket->titol }} ({{ $ticket->estat }})
                </a>
            </li>
        @endforeach
    </ul>
@endsection

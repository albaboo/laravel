@extends('layouts.app')

@section('content')
    <h1>{{ $ticket->codi_ticket }} - {{ $ticket->titol }}</h1>
    <p>{{ $ticket->descripcio }}</p>
    <p>Estat: {{ $ticket->estat }}</p>

    <h2>Comentaris</h2>
    <ul>
        @foreach($comentaris as $comentari)
            <li>{{ $comentari->autor->name }}: {{ $comentari->text }}</li>
        @endforeach
    </ul>

    <a href="{{ route('tickets.edit', [$projecte, $ticket]) }}">Editar Ticket</a>
@endsection

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

    <h3>Comentaris</h3>

    <ul>
        @foreach($ticket->comentaris as $comentari)
            <li>
                <strong>{{ $comentari->autor->name }}:</strong>
                {{ $comentari->text }}
                <form action="{{ route('comentaris.destroy', $comentari) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h4>Afegir comentari</h4>
    <form action="{{ route('comentaris.store', $ticket) }}" method="POST">
        @csrf
        <textarea name="text" class="form-control" rows="3" placeholder="Escriu el teu comentari..."></textarea>
        <button type="submit" class="btn btn-primary mt-2">Enviar</button>
    </form>
@endsection

@extends('layouts.app')

@section('content')
    <div style="padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
        <div style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <h1><b>{{ $ticket->codi_ticket }} - {{ $ticket->titol }}</b></h1>
            <p>{{ $ticket->descripcio }}</p>
            <p><b>Estat:</b> {{ $ticket->estat }}</p>
            <p><b>Hores:</b> {{ $ticket->registresTemps()->sum('hores') }}</p>
            <h3>Registres de temps</h3>
            @foreach ($ticket->registresTemps as $registre)
                <div>
                    <strong>{{ $registre->user->name }}</strong>
                    -
                    {{ $registre->hores }}h
                    -
                    {{ $registre->data->format('d/m/Y') }}

                    <p>{{ $registre->descripcio }}</p>
                </div>
            @endforeach
            <a style="padding: 6px 12px;
                background-color: #212529;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;" href="{{ route('tickets.edit', [$projecte, $ticket]) }}">Editar Ticket</a>
            @can('update', $ticket)
                <a href="{{ route('registreTemps.create', $ticket) }}">Registrar temps</a>
            @endcan
            <h2><b>Comentaris</b></h2>

            <ul>
                @foreach($ticket->comentaris as $comentari)
                    <li>
                        <b>{{ $comentari->autor->name }}:</b>
                        {{ $comentari->text }}
                        <br>
                        <form action="{{ route('comentaris.destroy', $comentari) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="
                padding: 6px 12px;
                background-color: #dc3545;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-left: 5px;
            ">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>

            <h4>Afegir comentari</h4>
            <form action="{{ route('comentaris.store', $ticket) }}" method="POST" style="margin-top: 10px;">
                @csrf
                <div style="margin-bottom: 12px;">
                    <textarea name="text" style="padding: 5px 10px; border-radius: 4px; border: 1px solid #ced4da;" rows="3" placeholder="Escriu el teu comentari..."></textarea>
                    <button type="submit" style="
                padding: 6px 12px;
                background-color: #0d6efd;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-left: 5px;
            ">Enviar</button>
                </div>

            </form>
        </div>
    </div>

@endsection

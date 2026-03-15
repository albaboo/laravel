@extends('layouts.app')

@section('content')
    <h1>Editar Ticket {{ $ticket->codi_ticket }}</h1>

    <form action="{{ route('tickets.update', [$projecte, $ticket]) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Titol</label>
        <input type="text" name="titol" value="{{ old('titol', $ticket->titol) }}">

        <label>Descripcio</label>
        <textarea name="descripcio">{{ old('descripcio', $ticket->descripcio) }}</textarea>

        <label>Estat</label>
        <select name="estat">
            <option value="NOU" {{ $ticket->estat=='NOU'?'selected':'' }}>NOU</option>
            <option value="OBERT" {{ $ticket->estat=='OBERT'?'selected':'' }}>OBERT</option>
            <option value="TANCAT" {{ $ticket->estat=='TANCAT'?'selected':'' }}>TANCAT</option>
        </select>

        <button type="submit">Actualitzar</button>
    </form>
@endsection

@extends('layouts.app')

@section('content')
    <h1>Crear Ticket per {{ $projecte->nom }}</h1>

    <form action="{{ route('tickets.store', $projecte) }}" method="POST">
        @csrf
        <label>Titol</label>
        <input type="text" name="titol" value="{{ old('titol') }}">

        <label>Descripcio</label>
        <textarea name="descripcio">{{ old('descripcio') }}</textarea>

        <button type="submit">Crear</button>
    </form>
@endsection

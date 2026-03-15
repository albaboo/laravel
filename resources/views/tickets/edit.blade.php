@extends('layouts.app')

@section('content')
    <div style="padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
        <div style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <h1>Editar Ticket</h1>

            <form action="{{ route('tickets.update', [$projecte, $ticket]) }}" method="POST" style="margin-top: 15px;">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 12px;">
                    <label>Titol</label>
                    <input style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;" type="text" name="titol" value="{{ old('titol', $ticket->titol) }}">
                </div>
                <div style="margin-bottom: 12px;">
                    <label>Descripcio</label>
                    <textarea style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;" name="descripcio">{{ old('descripcio', $ticket->descripcio) }}</textarea>
                </div>
                <div style="margin-bottom: 12px;">
                    <label>Estat</label>
                    <select name="estat" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                        <option value="NOU" {{ $ticket->estat=='NOU'?'selected':'' }}>NOU</option>
                        <option value="OBERT" {{ $ticket->estat=='OBERT'?'selected':'' }}>OBERT</option>
                        <option value="TANCAT" {{ $ticket->estat=='TANCAT'?'selected':'' }}>TANCAT</option>
                    </select>
                </div>
                <button type="submit" style="
                padding: 10px 20px;
                background-color: #0d6efd;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            ">Actualitzar</button>
            </form>
        </div>
    </div>

@endsection

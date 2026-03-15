@extends('layouts.app')

@section('content')
    <div style="padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
        <h1  style="color: #212529; margin-bottom: 20px;">Crear Ticket</h1>

        <form action="{{ route('tickets.store', $projecte) }}" method="POST"  style="color: #212529; margin-bottom: 20px;">
            @csrf
            <div style="margin-bottom: 15px;">
                <label>Titol</label>
                <input type="text" name="titol" value="{{ old('titol') }}" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                @error('titol')
                <div style="color:red">{{ $message }}</div>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <label>Descripcio</label>
                <textarea name="descripcio"  style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">{{ old('descripcio') }}</textarea>
                @error('descripcio')
                <div style="color:red">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" style="
            padding: 10px 20px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        " onmouseover="this.style.backgroundColor='#0b5ed7'" onmouseout="this.style.backgroundColor='#0d6efd'">Crear</button>
        </form>
    </div>
@endsection

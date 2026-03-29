@extends('layouts.app')

@section('content')
    <div style="padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
        <h1 style="color: #212529; margin-bottom: 20px;">
            Registrar Temps
        </h1>
        <form action="{{ route('registreTemps.store', $ticket) }}" method="POST" style="color: #212529;">
            @csrf
            <div style="margin-bottom: 15px;">
                <label>Data</label>
                <input type="date" name="data" value="{{ old('data') }}"
                       style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                @error('data')
                <div style="color:red">{{ $message }}</div>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <label>Hores</label>
                <input type="number" min="0.01" max="12" name="hores" value="{{ old('hores') }}"
                       style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                @error('hores')
                <div style="color:red">{{ $message }}</div>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <label>Descripció</label>
                <textarea name="descripcio"
                          style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">{{ old('descripcio') }}</textarea>
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
            "
                    onmouseover="this.style.backgroundColor='#0b5ed7'"
                    onmouseout="this.style.backgroundColor='#0d6efd'">
                Registrar
            </button>
        </form>
    </div>
@endsection

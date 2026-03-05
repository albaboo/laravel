@extends('layouts.app')

@section('content')
    <div style="padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
        <h1 style="color: #212529; margin-bottom: 20px;">Editar client</h1>

        <form action="{{ route('clients.update', $client->id) }}" method="POST"
              style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label>Nom del client</label>
                <input type="text" name="nombre" value="{{ old('nombre', $client->nombre) }}" required
                       style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>CIF</label>
                <input type="text" name="cif" value="{{ old('cif', $client->cif) }}" required
                       style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Email de contacte</label>
                <input type="email" name="email_contacte" value="{{ old('email_contacte', $client->email_contacte) }}"
                       style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Telèfon</label>
                <input type="text" name="telefon" value="{{ old('telefon', $client->telefon) }}"
                       style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Direcció</label>
                <input type="text" name="direccio" value="{{ old('direccio', $client->direccio) }}"
                       style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 20px;">
                <label>Actiu</label>
                <input type="checkbox" name="actiu" value="1" {{ $client->actiu ? 'checked' : '' }}>
            </div>

            <button type="submit" style="
            padding: 10px 20px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        " onmouseover="this.style.backgroundColor='#0b5ed7'" onmouseout="this.style.backgroundColor='#0d6efd'">
                Actualitzar client
            </button>
        </form>
    </div>
@endsection

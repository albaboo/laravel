@extends('layouts.app')
@section('content')
    <div style="padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
        <h1 style="color: #212529; margin-bottom: 20px;">Crear nou projecte</h1>
        <form action="{{ route('projectes.store') }}" method="POST" style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            @csrf
            <div style="margin-bottom: 15px;">
                <label>Nom del projecte</label>
                <input type="text" name="nom" value="{{ old('nom') }}" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                @error('nom')
                <div style="color:red">{{ $message }}</div>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <label>Client</label>
                <select name="client_id" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                    <option value="">Selecciona un client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->nombre }}</option>
                    @endforeach
                </select>
                @error('client_id')
                <div style="color:red">{{ $message }}</div>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <label>Descripció</label>
                <textarea name="descripcio" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">{{ old('descripcio') }}</textarea>
                @error('descripcio')
                <div style="color:red">{{ $message }}</div>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <label>Pressupost hores estimades</label>
                <input type="number" name="pressupost_hores_estimades" value="{{ old('pressupost_hores_estimades') }}" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                @error('pressupost_hores_estimades')
                <div style="color:red">{{ $message }}</div>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <label>Data inici</label>
                <input type="date" name="data_inici" value="{{ old('data_inici') }}"> style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                @error('data_inici')
                <div style="color:red">{{ $message }}</div>
                @enderror
            </div>
            <div style="margin-bottom: 20px;">
                <label>Data fi prevista</label>
                <input type="date" name="data_fi_prevista" value="{{ old('data_fi_prevista') }}" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                @error('data_fi_prevista')
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
        " onmouseover="this.style.backgroundColor='#0b5ed7'" onmouseout="this.style.backgroundColor='#0d6efd'">
                Crear projecte
            </button>
        </form>
        <a href="{{ route('projectes.index') }}" style="
        display: inline-block;
        padding: 10px 20px;
        background-color: #0d6efd;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        margin-bottom: 20px;
        margin-top: 20px;
    " onmouseover="this.style.backgroundColor='#0b5ed7'" onmouseout="this.style.backgroundColor='#0d6efd'">
            Cancel·lar
        </a>
        <a href="{{ route('projectes.index') }}" style="
        display: inline-block;
        padding: 10px 20px;
        background-color: #0d6efd;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        margin-bottom: 20px;
        margin-top: 20px;
    " onmouseover="this.style.backgroundColor='#0b5ed7'" onmouseout="this.style.backgroundColor='#0d6efd'">
            Cancel·lar
        </a>
    </div>
@endsection

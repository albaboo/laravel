@extends('layouts.app')
@section('content')
    <div style="padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
        <h1 style="color: #212529; margin-bottom: 20px;">Detalls del client</h1>
        <div style="
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    ">
            <p><strong>Nom:</strong> {{ $client->nombre }}</p>
            <p><strong>CIF:</strong> {{ $client->cif }}</p>
            <p><strong>Email de contacte:</strong> {{ $client->email_contacte ?? '-' }}</p>
            <p><strong>Telèfon:</strong> {{ $client->telefon ?? '-' }}</p>
            <p><strong>Direcció:</strong> {{ $client->direccio ?? '-' }}</p>
            <p><strong>Actiu:</strong> {{ $client->actiu ? 'Sí' : 'No' }}</p>
        </div>
        <a href="{{ route('clients.projectes', $client) }}" style="
        display: inline-block;
        padding: 10px 20px;
        background-color: #0d6efd;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        margin-bottom: 20px;
    " onmouseover="this.style.backgroundColor='#0b5ed7'" onmouseout="this.style.backgroundColor='#0d6efd'">
            Veure projectes
        </a>
    </div>
@endsection

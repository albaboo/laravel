@extends('layouts.app')
@section('content')
    <div style="padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
        <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        background-color: white;
        padding: 10px 15px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    ">
            <h1 style="margin:0; color: #212529;">Llista de clients actius ({{ $clients->count() }})</h1>
            <a href="{{ route('clients.create') }}" style="
            padding: 8px 16px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        ">Crear client</a>
        </div>
        @if($clients->count() > 0)
            <table id="clients-table" style="width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-top: 15px;">
                <thead>
                <tr style="background-color: #f5f5f5; text-align: left;">
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Nom</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">CIF</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Email</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Telèfon</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Direcció</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Projectes</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 8px;">{{ $client->nombre }}</td>
                        <td style="padding: 8px;">{{ $client->cif }}</td>
                        <td style="padding: 8px;">{{ $client->email_contacte ?? '-' }}</td>
                        <td style="padding: 8px;">{{ $client->telefon ?? '-' }}</td>
                        <td style="padding: 8px;">{{ $client->direccio ?? '-' }}</td>
                        <td style="padding: 8px;">{{ $client->projectes->count() ?? '-' }}</td>
                        <td style="padding: 8px;">
                            <a href="{{ route('clients.show', $client) }}" style="color:#0d6efd;">Veure</a> |
                            <a href="{{ route('clients.edit', $client) }}" style="color:#0d6efd;">Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p style="margin-top:15px;">No hi ha clients actius.</p>
        @endif
    </div>
    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#clients-table').DataTable({
                pageLength: 10,
                language: {
                    search: "Buscar client:",
                    lengthMenu: "Mostrar  _MENU_",
                    info: "Mostrant _START_ a _END_ de _TOTAL_ clients",
                    paginate: {
                        previous: "Anterior",
                        next: "Següent"
                    }
                }
            });
        });
    </script>
    @endpush
@endsection

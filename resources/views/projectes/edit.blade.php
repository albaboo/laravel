@extends('layouts.app')
@section('content')
    <div style="padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
        <div style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <h1>Editar projecte</h1>
            <form action="{{ route('projectes.update', $projecte->id) }}" method="POST" style="margin-top: 15px;">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 12px;">
                    <label>Codi projecte</label><br>
                    <input type="text" value="{{ $projecte->codi_projecte }}" disabled style="width:100%; padding:8px; border-radius:4px; border:1px solid #ced4da;">
                </div>
                <div style="margin-bottom: 12px;">
                    <label>Client</label><br>
                    <input type="text" value="{{ $projecte->client->nombre }} ({{ $projecte->client->cif }})" disabled style="width:100%; padding:8px; border-radius:4px; border:1px solid #ced4da;">
                </div>
                <div style="margin-bottom: 12px;">
                    <label>Nom</label><br>
                    <input type="text" name="nom" value="{{ old('nom', $projecte->nom) }}" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ced4da;">
                    @error('nom')
                    <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                <div style="margin-bottom: 12px;">
                    <label>Descripció</label><br>
                    <textarea name="descripcio" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ced4da;">{{ old('descripcio', $projecte->descripcio) }}</textarea>
                    @error('descripcio')
                    <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                <div style="margin-bottom: 12px;">
                    <label>Estat</label><br>
                    <select name="estat" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ced4da;">
                        @foreach(['PLANIFICACIO', 'EN_CURS', 'PAUSAT', 'FINALIZAT', 'CANCELAT'] as $estat)
                            <option value="{{ $estat }}" {{ $projecte->estat == $estat ? 'selected' : '' }}>{{ $estat }}</option>
                        @endforeach
                    </select>
                    @error('estat')
                    <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                <div style="margin-bottom: 12px;">
                    <label>Data inici</label><br>
                    <input type="date" name="data_inici" value="{{ old('data_inici', $projecte->data_inici?->format('Y-m-d')) }}" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ced4da;">
                    @error('data_inici')
                    <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                <div style="margin-bottom: 12px;">
                    <label>Data fi prevista</label><br>
                    <input type="date" name="data_fi_prevista" value="{{ old('data_fi_prevista', $projecte->data_fi_prevista?->format('Y-m-d')) }}" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ced4da;">
                    @error('data_fi_prevista')
                    <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                <div style="margin-bottom: 12px;">
                    <label>Pressupost hores estimades</label><br>
                    <input type="number" name="pressupost_hores_estimades" value="{{ old('pressupost_hores_estimades', $projecte->pressupost_hores_estimades) }}" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ced4da;">
                    @error('pressupost_hores_estimades')
                    <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" style="
                padding: 10px 20px;
                background-color: #0d6efd;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            ">Actualitzar projecte</button>
            </form>
        </div>
    </div>
@endsection

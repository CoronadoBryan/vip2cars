@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Editar Vehículo</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="license_plate">Placa</label>
                            <input type="text" class="form-control @error('license_plate') is-invalid @enderror" 
                                id="license_plate" name="license_plate" value="{{ old('license_plate', $vehicle->license_plate) }}" required>
                            @error('license_plate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="brand">Marca</label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror" 
                                id="brand" name="brand" value="{{ old('brand', $vehicle->brand) }}" required>
                            @error('brand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="model">Modelo</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                id="model" name="model" value="{{ old('model', $vehicle->model) }}" required>
                            @error('model')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="year">Año de Fabricación</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                id="year" name="year" value="{{ old('year', $vehicle->year) }}" min="1900" max="{{ date('Y') }}" required>
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group mb-4">
                    <label for="client_id">Cliente</label>
                    <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
                        <option value="">Seleccionar cliente...</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ (old('client_id') ?? $vehicle->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->first_name }} {{ $client->last_name }} - {{ $client->document_number }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Vehículo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
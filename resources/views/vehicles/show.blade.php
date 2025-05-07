@extends('layouts.app')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <!-- Encabezado responsivo -->
    <div class="row mb-3 mb-md-4 align-items-center">
        <div class="col-12 col-sm-6">
            <h2 class="fw-bold fs-3 fs-md-2 mb-2 mb-sm-0">Detalles del Vehículo</h2>
        </div>
        <div class="col-12 col-sm-6 text-sm-end">
            <a href="{{ route('vehicles.index') }}" class="btn btn-outline-dark w-100 w-sm-auto mb-3 mb-sm-0">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>
    </div>

    <!-- Información del Vehículo -->
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #E20022; color: white;">
            <div class="d-flex align-items-center">
                <i class="fas fa-car me-2"></i>
                <h5 class="card-title mb-0">Información del Vehículo</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; background-color: #000000;">
                            <i class="fas fa-car fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $vehicle->license_plate }}</h4>
                            <p class="text-muted mb-0">{{ $vehicle->brand }} {{ $vehicle->model }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <p class="mb-1 fw-semibold text-muted small">Marca:</p>
                    <p class="mb-0 fs-5">{{ $vehicle->brand }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 fw-semibold text-muted small">Modelo:</p>
                    <p class="mb-0 fs-5">{{ $vehicle->model }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 fw-semibold text-muted small">Año:</p>
                    <p class="mb-0 fs-5">{{ $vehicle->year }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 fw-semibold text-muted small">Fecha de Registro:</p>
                    <p class="mb-0 fs-5">{{ $vehicle->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Información del Propietario -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: #000000; color: white;">
            <div class="d-flex align-items-center">
                <i class="fas fa-user me-2"></i>
                <h5 class="card-title mb-0">Información del Propietario</h5>
            </div>
            <a href="{{ route('clients.show', $vehicle->client->id) }}" class="btn btn-sm" style="background-color: #E20022; color: white;">
                <i class="fas fa-eye me-2"></i> Ver Cliente
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; background-color: #E20022;">
                            <span style="font-size: 1.5rem;">{{ substr($vehicle->client->first_name, 0, 1) }}{{ substr($vehicle->client->last_name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $vehicle->client->first_name }} {{ $vehicle->client->last_name }}</h4>
                            <p class="text-muted mb-0">Propietario del vehículo</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <p class="mb-1 fw-semibold text-muted small">Documento:</p>
                    <p class="mb-0 fs-5">{{ $vehicle->client->document_number ?? 'No registrado' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 fw-semibold text-muted small">Teléfono:</p>
                    <p class="mb-0 fs-5">{{ $vehicle->client->phone }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 fw-semibold text-muted small">Email:</p>
                    <p class="mb-0 fs-5">{{ $vehicle->client->email }}</p>
                </div>
             
            </div>
        </div>
    </div>

    <!-- Vista para móviles (opcional) -->
    <div class="d-md-none mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="card-title mb-0">{{ $vehicle->license_plate }}</h5>
                    <span class="badge" style="background-color: #E20022;">{{ $vehicle->year }}</span>
                </div>
                <p class="card-text mb-3">
                    <i class="fas fa-car me-2" style="color: #E20022;"></i> {{ $vehicle->brand }} {{ $vehicle->model }}
                </p>
                <p class="card-text mb-3">
                    <i class="fas fa-user me-2" style="color: #E20022;"></i> {{ $vehicle->client->first_name }} {{ $vehicle->client->last_name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Acciones -->
    <div class="card shadow mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="card-title mb-0">Acciones</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 mb-md-0">
                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn w-100" style="background-color: #E20022; color: white;">
                        <i class="fas fa-edit me-2"></i> Editar Vehículo
                    </a>
                </div>
                <div class="col-12 col-md-6">
                    <button type="button" class="btn w-100" style="background-color: #000000; color: white;" data-bs-toggle="modal" data-bs-target="#deleteVehicleModal">
                        <i class="fas fa-trash me-2"></i> Eliminar Vehículo
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
<div class="modal fade" id="deleteVehicleModal" tabindex="-1" aria-labelledby="deleteVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #E20022; color: white;">
                <h5 class="modal-title" id="deleteVehicleModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Confirmar eliminación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de eliminar el vehículo con placa <strong>{{ $vehicle->license_plate }}</strong>?</p>
                <p class="text-muted mb-0">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background-color: #E20022; color: white;">
                        <i class="fas fa-trash me-2"></i>Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
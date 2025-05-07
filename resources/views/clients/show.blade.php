@extends('layouts.app')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <!-- Encabezado responsivo -->
    <div class="row mb-3 mb-md-4 align-items-center">
        <div class="col-12 col-sm-6">
            <h2 class="fw-bold fs-3 fs-md-2 mb-2 mb-sm-0">Detalles del Cliente</h2>
        </div>
        <div class="col-12 col-sm-6 text-sm-end">
            <a href="{{ route('clients.index') }}" class="btn btn-outline-dark w-100 w-sm-auto mb-3 mb-sm-0">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>
    </div>

    <!-- Información Personal -->
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #E20022; color: white;">
            <div class="d-flex align-items-center">
                <i class="fas fa-user me-2"></i>
                <h5 class="card-title mb-0">Información Personal</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; background-color: #000000;">
                            <span style="font-size: 1.5rem;">{{ substr($client->first_name, 0, 1) }}{{ substr($client->last_name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $client->first_name }} {{ $client->last_name }}</h4>
                            <p class="text-muted mb-0">Cliente desde {{ $client->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <p class="mb-1 fw-semibold text-muted small">Número de Documento:</p>
                    <p class="mb-0 fs-5">{{ $client->document_number }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 fw-semibold text-muted small">Teléfono:</p>
                    <p class="mb-0 fs-5">{{ $client->phone }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 fw-semibold text-muted small">Email:</p>
                    <p class="mb-0 fs-5">{{ $client->email }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 fw-semibold text-muted small">Fecha de Registro:</p>
                    <p class="mb-0 fs-5">{{ $client->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Vehículos Registrados -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: #000000; color: white;">
            <div class="d-flex align-items-center">
                <i class="fas fa-car me-2"></i>
                <h5 class="card-title mb-0">Vehículos Registrados</h5>
            </div>
            <a href="{{ route('vehicles.create') }}" class="btn btn-sm" style="background-color: #E20022; color: white;">
                <i class="fas fa-plus me-2"></i> Añadir Vehículo
            </a>
        </div>
        <div class="card-body p-0">
            @if($client->vehicles->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Placa</th>
                                <th class="d-none d-md-table-cell">Marca</th>
                                <th>Modelo</th>
                                <th class="d-none d-md-table-cell">Año</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($client->vehicles as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->license_plate }}</td>
                                    <td class="d-none d-md-table-cell">{{ $vehicle->brand }}</td>
                                    <td>{{ $vehicle->model }}</td>
                                    <td class="d-none d-md-table-cell">{{ $vehicle->year }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1 gap-md-2">
                                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-sm btn-outline-primary" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar" 
                                                    data-bs-toggle="modal" data-bs-target="#deleteVehicleModal{{ $vehicle->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            
                                            <!-- Modal de confirmación para eliminar vehículo -->
                                            <div class="modal fade" id="deleteVehicleModal{{ $vehicle->id }}" tabindex="-1" 
                                                 aria-labelledby="deleteVehicleModalLabel{{ $vehicle->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="background-color: #E20022; color: white;">
                                                            <h5 class="modal-title" id="deleteVehicleModalLabel{{ $vehicle->id }}">
                                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                                Confirmar eliminación
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" 
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
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
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4 text-center">
                    <div class="mb-3">
                        <i class="fas fa-car-alt text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-muted mb-3">Este cliente no tiene vehículos registrados.</p>
                    <a href="{{ route('vehicles.create') }}" class="btn" style="background-color: #E20022; color: white;">
                        <i class="fas fa-plus me-2"></i> Registrar un vehículo ahora
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Vista de tarjetas para móviles (alternativa a la tabla) -->
    @if($client->vehicles->count() > 0)
    <div class="d-md-none mb-4">
        <h6 class="mb-3">Vehículos en Vista Móvil</h6>
        <div class="row">
            @foreach($client->vehicles as $vehicle)
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-0">{{ $vehicle->license_plate }}</h5>
                                <span class="badge" style="background-color: #E20022;">{{ $vehicle->year }}</span>
                            </div>
                            <p class="card-text mb-1">
                                <i class="fas fa-car me-2" style="color: #E20022;"></i> {{ $vehicle->brand }} {{ $vehicle->model }}
                            </p>
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-sm" style="background-color: #000000; color: white;">
                                    <i class="fas fa-eye me-1"></i> Ver
                                </a>
                                <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-warning text-white">
                                    <i class="fas fa-edit me-1"></i> Editar
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" 
                                        data-bs-toggle="modal" data-bs-target="#deleteVehicleModalMobile{{ $vehicle->id }}">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </button>
                                
                                <!-- Modal de confirmación móvil -->
                                <div class="modal fade" id="deleteVehicleModalMobile{{ $vehicle->id }}" tabindex="-1" 
                                     aria-labelledby="deleteVehicleModalMobileLabel{{ $vehicle->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #E20022; color: white;">
                                                <h5 class="modal-title" id="deleteVehicleModalMobileLabel{{ $vehicle->id }}">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                                    Confirmar eliminación
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" 
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
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
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Acciones -->
    <div class="card shadow mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="card-title mb-0">Acciones</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 mb-md-0">
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn w-100" style="background-color: #E20022; color: white;">
                        <i class="fas fa-edit me-2"></i> Editar Cliente
                    </a>
                </div>
                <div class="col-12 col-md-6">
                    <button type="button" class="btn w-100" style="background-color: #000000; color: white;" 
                            data-bs-toggle="modal" data-bs-target="#deleteClientModal">
                        <i class="fas fa-trash me-2"></i> Eliminar Cliente
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar cliente -->
<div class="modal fade" id="deleteClientModal" tabindex="-1" aria-labelledby="deleteClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #E20022; color: white;">
                <h5 class="modal-title" id="deleteClientModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Confirmar eliminación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de eliminar al cliente <strong>{{ $client->first_name }} {{ $client->last_name }}</strong>?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Atención:</strong> Esta acción eliminará también todos los vehículos asociados a este cliente.
                </div>
                <p class="text-muted mb-0">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
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
@extends('layouts.app')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <!-- Encabezado responsivo -->
    <div class="row mb-3 mb-md-4 align-items-center">
        <div class="col-12 col-sm-6">
            <h2 class="fw-bold fs-3 fs-md-2 mb-2 mb-sm-0">Gestión de Vehículos</h2>
        </div>
        <div class="col-12 col-sm-6 text-sm-end">
            <a href="{{ route('vehicles.create') }}" class="btn btn-primary w-100 w-sm-auto">
                <i class="fas fa-plus me-2"></i> Nuevo Vehículo
            </a>
        </div>
    </div>

    <!-- Tarjeta responsiva -->
    <div class="card shadow">
        <!-- Cabecera con búsqueda responsiva -->
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 mb-3 mb-md-0">
                    <h5 class="mb-0 fs-5">Listado de Vehículos</h5>
                </div>
                <div class="col-12 col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar vehículo..." id="searchInput">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabla responsiva con scroll horizontal -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Placa</th>
                            <th class="d-none d-md-table-cell">Marca</th>
                            <th>Modelo</th>
                            <th class="d-none d-md-table-cell">Año</th>
                            <th class="d-none d-lg-table-cell">Cliente</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vehicles as $vehicle)
                            <tr>
                                <td>{{ $vehicle->license_plate }}</td>
                                <td class="d-none d-md-table-cell">{{ $vehicle->brand }}</td>
                                <td>{{ $vehicle->model }}</td>
                                <td class="d-none d-md-table-cell">{{ $vehicle->year }}</td>
                                <td class="d-none d-lg-table-cell">{{ $vehicle->client->first_name }} {{ $vehicle->client->last_name }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1 gap-md-2">
                                        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-sm btn-outline-primary" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                title="Eliminar" data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $vehicle->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- Modal de confirmación para eliminar -->
                                    <div class="modal fade" id="deleteModal{{ $vehicle->id }}" tabindex="-1" 
                                         aria-labelledby="deleteModalLabel{{ $vehicle->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #E20022; color: white;">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $vehicle->id }}">
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
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-car text-muted mb-2" style="font-size: 2rem;"></i>
                                        <p class="text-muted mb-0">No hay vehículos registrados.</p>
                                        <a href="{{ route('vehicles.create') }}" class="btn btn-sm btn-primary mt-3">
                                            <i class="fas fa-plus me-1"></i> Agregar Vehículo
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación responsiva -->
            @if($vehicles->count() > 0)
            <div class="border-top">
                <div class="row align-items-center p-3">
                    <div class="col-12 col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-muted small">
                            Mostrando {{ $vehicles->firstItem() ?? 0 }} - {{ $vehicles->lastItem() ?? 0 }} de {{ $vehicles->total() }} registros
                        </span>
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Vista de tarjetas para móviles (alternativa a la tabla) -->
    <div class="d-md-none mt-3">
        <div class="row">
            @forelse($vehicles as $vehicle)
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-0">{{ $vehicle->license_plate }}</h5>
                                <span class="badge bg-primary">{{ $vehicle->year }}</span>
                            </div>
                            <p class="card-text mb-1">
                                <i class="fas fa-car me-2 text-primary"></i> {{ $vehicle->brand }} {{ $vehicle->model }}
                            </p>
                            <p class="card-text mb-3">
                                <i class="fas fa-user me-2 text-primary"></i> {{ $vehicle->client->first_name }} {{ $vehicle->client->last_name }}
                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye me-1"></i> Ver
                                </a>
                                <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-warning text-white">
                                    <i class="fas fa-edit me-1"></i> Editar
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" 
                                        data-bs-toggle="modal" data-bs-target="#deleteModalMobile{{ $vehicle->id }}">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </button>
                                
                                <!-- Modal de confirmación móvil -->
                                <div class="modal fade" id="deleteModalMobile{{ $vehicle->id }}" tabindex="-1" 
                                     aria-labelledby="deleteModalMobileLabel{{ $vehicle->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #E20022; color: white;">
                                                <h5 class="modal-title" id="deleteModalMobileLabel{{ $vehicle->id }}">
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
            @empty
                <!-- Estado vacío para móviles -->
                <div class="col-12 text-center py-4">
                    <i class="fas fa-car text-muted mb-2" style="font-size: 3rem;"></i>
                    <p class="text-muted mb-3">No hay vehículos registrados.</p>
                    <a href="{{ route('vehicles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Agregar Vehículo
                    </a>
                </div>
            @endforelse
            
            <!-- Paginación para móviles -->
            @if($vehicles->count() > 0)
            <div class="col-12 d-flex justify-content-center mt-3">
                {{ $vehicles->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Búsqueda en tabla y tarjetas
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let input = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('tbody tr');
        let cards = document.querySelectorAll('.d-md-none .card');
        
        // Filtrar filas de la tabla
        tableRows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? '' : 'none';
        });
        
        // Filtrar tarjetas en móviles
        cards.forEach(card => {
            let text = card.textContent.toLowerCase();
            card.parentElement.style.display = text.includes(input) ? '' : 'none';
        });
    });
</script>
@endsection
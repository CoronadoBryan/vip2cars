@extends('layouts.app')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <!-- Encabezado responsivo -->
    <div class="row mb-3 mb-md-4 align-items-center">
        <div class="col-12 col-sm-6">
            <h2 class="fw-bold fs-3 fs-md-2 mb-2 mb-sm-0">Gestión de Clientes</h2>
        </div>
        <div class="col-12 col-sm-6 text-sm-end">
            <a href="{{ route('clients.create') }}" class="btn btn-primary w-100 w-sm-auto">
                <i class="fas fa-plus me-2"></i> Nuevo Cliente
            </a>
        </div>
    </div>

    <!-- Tarjeta responsiva -->
    <div class="card shadow">
        <!-- Cabecera con búsqueda responsiva -->
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 mb-3 mb-md-0">
                    <h5 class="mb-0 fs-5">Listado de Clientes</h5>
                </div>
                <div class="col-12 col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar cliente..." id="searchInput">
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
                            <th class="d-none d-md-table-cell ps-3">ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th class="d-none d-md-table-cell">Documento</th>
                            <th class="d-none d-lg-table-cell">Correo</th>
                            <th>Teléfono</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                            <tr>
                                <td class="d-none d-md-table-cell ps-3">{{ $client->id }}</td>
                                <td>{{ $client->first_name }}</td>
                                <td>{{ $client->last_name }}</td>
                                <td class="d-none d-md-table-cell">{{ $client->document_number }}</td>
                                <td class="d-none d-lg-table-cell">{{ $client->email }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1 gap-md-2">
                                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-outline-primary" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                title="Eliminar" data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $client->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- Modal de confirmación para eliminar -->
                                    <div class="modal fade" id="deleteModal{{ $client->id }}" tabindex="-1" 
                                         aria-labelledby="deleteModalLabel{{ $client->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #E20022; color: white;">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $client->id }}">
                                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                                        Confirmar eliminación
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" 
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
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
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-users text-muted mb-2" style="font-size: 2rem;"></i>
                                        <p class="text-muted mb-0">No hay clientes registrados.</p>
                                        <a href="{{ route('clients.create') }}" class="btn btn-sm btn-primary mt-3">
                                            <i class="fas fa-plus me-1"></i> Agregar Cliente
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación responsiva -->
            @if($clients->count() > 0)
            <div class="border-top">
                <div class="row align-items-center p-3">
                    <div class="col-12 col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-muted small">
                            Mostrando {{ $clients->firstItem() ?? 0 }} - {{ $clients->lastItem() ?? 0 }} de {{ $clients->total() }} registros
                        </span>
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Vista de tarjetas para móviles (alternativa a la tabla) -->
    <div class="d-md-none mt-3">
        <div class="row">
            @forelse($clients as $client)
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $client->first_name }} {{ $client->last_name }}</h5>
                            <p class="card-text mb-1">
                                <i class="fas fa-phone me-2 text-primary"></i> {{ $client->phone }}
                            </p>
                            <p class="card-text mb-1">
                                <i class="fas fa-envelope me-2 text-primary"></i> {{ $client->email }}
                            </p>
                            <p class="card-text mb-3">
                                <i class="fas fa-id-card me-2 text-primary"></i> {{ $client->document_number }}
                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye me-1"></i> Ver
                                </a>
                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning text-white">
                                    <i class="fas fa-edit me-1"></i> Editar
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" 
                                        data-bs-toggle="modal" data-bs-target="#deleteModalMobile{{ $client->id }}">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </button>
                                
                                <!-- Modal de confirmación móvil -->
                                <div class="modal fade" id="deleteModalMobile{{ $client->id }}" tabindex="-1" 
                                     aria-labelledby="deleteModalMobileLabel{{ $client->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #E20022; color: white;">
                                                <h5 class="modal-title" id="deleteModalMobileLabel{{ $client->id }}">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                                    Confirmar eliminación
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" 
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
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
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Estado vacío para móviles -->
                <div class="col-12 text-center py-4">
                    <i class="fas fa-users text-muted mb-2" style="font-size: 3rem;"></i>
                    <p class="text-muted mb-3">No hay clientes registrados.</p>
                    <a href="{{ route('clients.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Agregar Cliente
                    </a>
                </div>
            @endforelse
            
            <!-- Paginación para móviles -->
            @if($clients->count() > 0)
            <div class="col-12 d-flex justify-content-center mt-3">
                {{ $clients->links() }}
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
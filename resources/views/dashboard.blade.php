@extends('layouts.app')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <!-- Encabezado -->
    <div class="row mb-4 align-items-center">
        <div class="col-12">
            <h2 class="fw-bold fs-3 fs-md-2 mb-0">
                <i class="fas fa-tachometer-alt me-2" style="color: #E20022;"></i>Dashboard
            </h2>
            <p class="text-muted mb-0">Resumen general del sistema</p>
        </div>
    </div>
    
    <!-- Tarjetas de resumen -->
    <div class="row">
        <!-- Clientes -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3" style="background-color: #E20022; color: white;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users me-2"></i>
                        <h5 class="card-title mb-0">Clientes Registrados</h5>
                    </div>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="row align-items-center mb-3">
                        <div class="col-auto">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px; background-color: #000000;">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                        <div class="col text-end">
                            <h2 class="display-4 fw-bold mb-0">{{ \App\Models\Client::count() }}</h2>
                            <p class="text-muted small mb-0">Total de clientes</p>
                        </div>
                    </div>
                    <div class="mt-auto text-end">
                        <a href="{{ route('clients.index') }}" class="btn" style="background-color: #E20022; color: white;">
                            <i class="fas fa-arrow-right me-2"></i>Ver todos
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Vehículos -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3" style="background-color: #000000; color: white;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-car me-2"></i>
                        <h5 class="card-title mb-0">Vehículos Registrados</h5>
                    </div>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="row align-items-center mb-3">
                        <div class="col-auto">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px; background-color: #E20022;">
                                <i class="fas fa-car fa-2x"></i>
                            </div>
                        </div>
                        <div class="col text-end">
                            <h2 class="display-4 fw-bold mb-0">{{ \App\Models\Vehicle::count() }}</h2>
                            <p class="text-muted small mb-0">Total de vehículos</p>
                        </div>
                    </div>
                    <div class="mt-auto text-end">
                        <a href="{{ route('vehicles.index') }}" class="btn" style="background-color: #000000; color: white;">
                            <i class="fas fa-arrow-right me-2"></i>Ver todos
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Marcas -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 bg-dark text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tag me-2"></i>
                        <h5 class="card-title mb-0">Marcas Registradas</h5>
                    </div>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="row align-items-center mb-3">
                        <div class="col-auto">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px; background-color: #343a40;">
                                <i class="fas fa-tags fa-2x"></i>
                            </div>
                        </div>
                        <div class="col text-end">
                            <h2 class="display-4 fw-bold mb-0">{{ \App\Models\Vehicle::distinct('brand')->count('brand') }}</h2>
                            <p class="text-muted small mb-0">Marcas distintas</p>
                        </div>
                    </div>
                    <div class="mt-auto text-end">
                        <a href="{{ route('vehicles.index') }}" class="btn btn-dark">
                            <i class="fas fa-arrow-right me-2"></i>Ver detalles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas y gráficos -->
    <div class="row">
        <!-- Últimos clientes registrados -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 bg-white">
                    <h5 class="mb-0">Últimos Clientes Registrados</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Fecha Registro</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\Client::latest()->take(5)->get() as $client)
                                    <tr>
                                        <td>{{ $client->first_name }} {{ $client->last_name }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>{{ $client->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-3">No hay clientes registrados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Últimos vehículos registrados -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 bg-white">
                    <h5 class="mb-0">Últimos Vehículos Registrados</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Placa</th>
                                    <th>Marca/Modelo</th>
                                    <th>Cliente</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\Vehicle::with('client')->latest()->take(5)->get() as $vehicle)
                                    <tr>
                                        <td>{{ $vehicle->license_plate }}</td>
                                        <td>{{ $vehicle->brand }} {{ $vehicle->model }}</td>
                                        <td>{{ $vehicle->client->first_name }} {{ $vehicle->client->last_name }}</td>
                                        <td>
                                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-3">No hay vehículos registrados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accesos rápidos -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Accesos Rápidos</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <a href="{{ route('clients.create') }}" class="btn btn-outline-dark w-100 py-3">
                                <i class="fas fa-user-plus fa-2x mb-2"></i>
                                <br>Nuevo Cliente
                            </a>
                        </div>
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <a href="{{ route('vehicles.create') }}" class="btn btn-outline-dark w-100 py-3">
                                <i class="fas fa-car-alt fa-2x mb-2"></i>
                                <br>Nuevo Vehículo
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('clients.index') }}" class="btn" style="background-color: #E20022; color: white; width: 100%; padding-top: 1rem; padding-bottom: 1rem;">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <br>Ver Clientes
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('vehicles.index') }}" class="btn" style="background-color: #000000; color: white; width: 100%; padding-top: 1rem; padding-bottom: 1rem;">
                                <i class="fas fa-car fa-2x mb-2"></i>
                                <br>Ver Vehículos 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
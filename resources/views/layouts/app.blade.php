<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VIP2CARS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Estilos específicos del sidebar */
        #sidebar-wrapper {
            background-color: var(--dark);
            width: var(--sidebar-width);
            min-height: 100vh;
            transition: var(--transition);
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1030;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 1.5rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        #sidebar-wrapper .sidebar-heading h3 {
            color: var(--text-white);
            font-weight: 600;
            letter-spacing: 1px;
            margin: 0;
        }

        #sidebar-wrapper .list-group {
            width: 100%;
            padding: 0;
        }

        #sidebar-wrapper .list-group-item {
            background-color: transparent;
            color: var(--gray-300);
            border: none;
            border-radius: 0;
            padding: 0.8rem 1.25rem;
            font-size: 0.95rem;
            transition: var(--transition-fast);
            border-left: 3px solid transparent;
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--light);
            border-left: 3px solid var(--primary);
        }

        #sidebar-wrapper .list-group-item.active {
            background-color: rgba(226, 0, 34, 0.15);
            color: var(--light);
            border-left: 3px solid var(--primary);
        }

        #sidebar-wrapper .list-group-item i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }

        /* Estado colapsado del sidebar */
        #wrapper.toggled #sidebar-wrapper {
            width: var(--sidebar-collapsed-width);
        }

        #wrapper.toggled #sidebar-wrapper .sidebar-heading h3,
        #wrapper.toggled #sidebar-wrapper .list-group-item span {
            display: none;
        }

        #wrapper.toggled #sidebar-wrapper .list-group-item {
            text-align: center;
            padding: 0.8rem;
        }

        #wrapper.toggled #sidebar-wrapper .list-group-item i {
            margin-right: 0;
            font-size: 1.25rem;
        }
        .dos {
                color: red;
            }
        
        /* Sidebar responsivo */
        @media (max-width: 768px) {
            #sidebar-wrapper {
                width: 0;
                overflow: hidden;
            }
            
            #page-content-wrapper {
                width: 100%;
                margin-left: 0;
            }
            
            #wrapper.toggled #sidebar-wrapper {
                width: var(--sidebar-width);
                box-shadow: 0 0 15px rgba(0,0,0,0.2);
            }
            
            #wrapper.toggled #page-content-wrapper {
                width: 100%;
                margin-left: 0;
            }
            
            body.sidebar-active {
                overflow: hidden;
            }
            
            #sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1020;
            }
            
            #wrapper.toggled #sidebar-overlay {
                display: block;
            }
           
        }
    </style>
</head>
<body class="font-sans antialiased bg-light">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar Overlay para móviles -->
        <div id="sidebar-overlay"></div>
        
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading p-3 text-center">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTcNW9vpRQfQMpqsaA9bdXY2I90UZdnjyVz2r42IjrDVvcMO4X4fDz3Y3uo06Gu2uJTm8&usqp=CAU" alt="Logo" class="img-fluid mb-2" style="max-width: 30%; height: auto;">
                <h3>VIP<spam class="dos">2</spam>CARS</h3>
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('dashboard') }}" class="list-group-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i> <span>Dashboard</span>
                </a>
                <a href="{{ route('clients.index') }}" class="list-group-item {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i> <span>Clientes</span>
                </a>
                <a href="{{ route('vehicles.index') }}" class="list-group-item {{ request()->routeIs('vehicles.*') ? 'active' : '' }}">
                    <i class="fas fa-car me-2"></i> <span>Vehículos</span>
                </a>
                
            </div>
        </div>
        
        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            
            
            <div class="container-fluid p-4">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                <!-- Page Content -->
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Toggle sidebar
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
                $("body").toggleClass("sidebar-active");
            });
            
            // Cerrar sidebar al hacer clic en el overlay (en móviles)
            $("#sidebar-overlay").click(function() {
                $("#wrapper").removeClass("toggled");
                $("body").removeClass("sidebar-active");
            });
            
            // Cerrar sidebar en móviles al hacer clic en un enlace
            $("#sidebar-wrapper .list-group-item").click(function() {
                if ($(window).width() < 768) {
                    $("#wrapper").removeClass("toggled");
                    $("body").removeClass("sidebar-active");
                }
            });
            
            // Detectar cambio de tamaño de ventana para adaptar el sidebar
            $(window).resize(function() {
                if ($(window).width() > 768) {
                    // En pantallas grandes, quitar clase toggled si existe
                    $("#wrapper").removeClass("toggled");
                    $("body").removeClass("sidebar-active");
                }
            });
        });
    </script>
    
    <!-- Page specific scripts -->
    @stack('scripts')
</body>
</html>
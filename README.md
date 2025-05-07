# VIP2CARS - Sistema de Gestión de Vehículos

Sistema simple CRUD.

![Screenshot](https://i.ibb.co/7Ndq3tk7/vip2.png)

## Características Principales

- **Gestión de Clientes**: Registro completo de información de clientes con búsqueda.
- **Gestión de Vehículos**: Seguimiento detallado de vehículos vinculados a clientes.
- **Diseño Responsivo**: Interfaz adaptable a dispositivos móviles y escritorio.
- **Interfaz Moderna**: Diseño basado en la identidad de marca VIP2CARS (rojo #E20022 y negro #000000).

## Requisitos del Sistema

- PHP >= 8.2
- Composer
- MySQL o MariaDB
- Node.js y NPM
- Laravel 12.x

## Instalación

Sigue estos pasos para instalar el proyecto en tu entorno local:

### 1. Clonar el Repositorio

```bash
git clone https://github.com/CoronadoBryan/vip2cars.git
cd vip2cars
```

### 2. Instalar Dependencias de PHP

```bash
composer install
```

### 3. Instalar Dependencias de Node.js

```bash
npm install
```

### 4. Configurar Variables de Entorno

Copia el archivo `.env.example` a `.env` y configura las variables de entorno:

```bash
cp .env.example .env
```

Configura la conexión a la base de datos en el archivo `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vip2cars_db   <- aqui el nombre de tu base de datos
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generar Clave de la Aplicación

```bash
php artisan key:generate
```

### 6. Crear la Base de Datos

Crea una base de datos en MySQL con el nombre que configuraste en el archivo `.env`:

```sql
CREATE DATABASE vip2cars_db;
```

### 7. Ejecutar Migraciones y Seeders

```bash
php artisan migrate --seed
```

### 8. Instalar Dependencias de Frontend y Compilar Assets

```bash
npm install
npm run dev
```

O para producción:

```bash
npm install
npm run build
```

### 9. Iniciar el Servidor

```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`



## Estructura del Proyecto

```
vip2cars/
├── app/                        # Carpeta principal con lógica de la aplicación
│   ├── Console/                # Comandos Artisan
│   ├── Exceptions/             # Manejo de excepciones
│   ├── Http/                   # Controladores, Middleware, Requests
│   │   ├── Controllers/        # Controladores de la aplicación
│   │   ├── Middleware/         # Middleware
│   │   └── Requests/           # Form Requests para validación
│   ├── Models/                 # Modelos
│   │   ├── Client.php          # Modelo de Cliente
│   │   └── Vehicle.php         # Modelo de Vehículo
│   └── Providers/              # Proveedores de servicios
├── bootstrap/                  # Archivos de arranque
├── config/                     # Archivos de configuración
├── database/                   # Migraciones y seeders
│   ├── factories/              # Factories para testing
│   ├── migrations/             # Migraciones de la base de datos
│   └── seeders/                # Seeders para datos iniciales
├── public/                     # Archivos públicos
│   ├── css/                    # CSS compilado
│   ├── js/                     # JavaScript compilado
│   └── images/                 # Imágenes
├── resources/                  # Recursos
│   ├── css/                    # Estilos CSS
│   │   └── app.css             # Archivo CSS principal con variables
│   ├── js/                     # JavaScript
│   └── views/                  # Vistas Blade
│       ├── clients/            # Vistas de Clientes
│       │   ├── index.blade.php # Lista de Clientes
│       │   ├── show.blade.php  # Detalles de Cliente
│       │   ├── create.blade.php # Crear Cliente
│       │   └── edit.blade.php  # Editar Cliente
│       ├── vehicles/           # Vistas de Vehículos
│       │   ├── index.blade.php # Lista de Vehículos
│       │   ├── show.blade.php  # Detalles de Vehículo
│       │   ├── create.blade.php # Crear Vehículo
│       │   └── edit.blade.php  # Editar Vehículo
│       └── layouts/            # Plantillas de Diseño
│           └── app.blade.php   # Plantilla Principal con Sidebar
├── routes/                     # Definición de rutas
│   ├── web.php                 # Rutas web
│   └── api.php                 # Rutas API
├── storage/                    # Almacenamiento
├── tests/                      # Tests
├── .env                        # Variables de entorno
├── .env.example                # Ejemplo de variables de entorno
├── composer.json               # Dependencias PHP
├── package.json                # Dependencias Node.js
└── vite.config.js              # Configuración de Vite
```

## Módulos Principales

### Clientes

- **Listado de Clientes**: Vista responsiva con búsqueda y paginación 
- **Detalles de Cliente**: Información completa y listado de vehículos
- **Crear/Editar Cliente**: Formularios con validación

### Vehículos

- **Listado de Vehículos**: Vista responsiva con búsqueda y paginación
- **Detalles de Vehículo**: Información completa y datos del propietario
- **Crear/Editar Vehículo**: Formularios con validación

## Estilos y Diseño

El diseño utiliza Bootstrap 5 junto con estilos personalizados definidos en `app.css`. La paleta de colores se basa en la identidad de marca VIP2CARS:

- **Rojo Principal**: #E20022
- **Negro**: #000000
- **Blanco**: #FFFFFF
- **Grises**: Varios tonos para contraste

## Componentes Principales

### Sidebar Responsivo

Componente lateral que colapsa en dispositivos móviles y muestra los menús principales.

### Tablas Responsivas

Las tablas se adaptan a dispositivos móviles mostrando tarjetas individuales para mejor legibilidad.

### Modales de Confirmación

Se utilizan modales para confirmar acciones importantes como la eliminación de registros.

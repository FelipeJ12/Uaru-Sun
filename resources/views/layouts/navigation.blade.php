<!-- Este meta va en tu layout base (layouts.app) dentro del <head> -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="40" height="40">
            <span>ÚARU SUN</span>
        </a>

        <!-- Botón Hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido del Navbar -->
        <div class="collapse navbar-collapse justify-content-between align-items-center" id="mainNavbar">

            <!-- Menú Flora, Fauna, Paisajes alineados -->
            <div class="d-flex flex-wrap align-items-center gap-2 me-auto">
                @auth
                    @if(Auth::user()->role === 'user' || Auth::user()->role === 'admin')
                        <a class="nav-link text-white {{ request()->routeIs('fauna.index') ? 'active' : '' }}" href="{{ route('fauna.index') }}">
                            <i class="fas fa-paw me-1"></i> Fauna
                        </a>
                        <a class="nav-link text-white {{ request()->routeIs('flora.index') ? 'active' : '' }}" href="{{ route('flora.index') }}">
                            <i class="fas fa-leaf me-1"></i> Flora
                        </a>
                        <a class="nav-link text-white {{ request()->routeIs('paisajes.index') ? 'active' : '' }}" href="{{ route('paisajes.index') }}">
                            <i class="fas fa-image me-1"></i> Paisajes
                        </a>
                    @endif
                @endauth

                <!-- Íconos integrados -->
                <a class="nav-link text-white" href="{{ route('store') }}">
                    <i class="fas fa-store fa-lg"></i>
                </a>
                <a class="nav-link text-white" href="{{ route('cart.view') }}">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                </a>
            </div>

            <!-- Buscador -->
            <form class="d-flex align-items-center mb-2 mb-lg-0 w-100 w-lg-auto" method="GET" action="{{ route('admin.especies.index') }}">
                <div class="input-group input-group-sm w-100">
                    <input type="text" class="form-control" placeholder="Buscar especie..." name="query" value="{{ request('query') }}">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- Menú Usuario -->
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <div class="card h-100 shadow bg-success bg-opacity-50 text-white border-light position-relative rounded-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('login', 'admin.especies.index', 'UsuarioPost.create', 'profile.index') ? 'active' : '' }}" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            @auth {{ Auth::user()->name }} @else Menú @endauth
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @guest
                                <li>
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i> Ingresar
                                    </a>
                                </li>
                            @endguest

                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.especies.index') }}"><i class="fas fa-cog me-1"></i> Administrar Publicaciones</a></li>
                                    <li><a class="dropdown-item" href="{{ route('bitacora.bita') }}"><i class="fas fa-clipboard-list me-1"></i> Ver Bitácora</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/admin/users') }}"><i class="fas fa-users me-1"></i> Usuarios Suscritos</a></li>
                                    <li><a class="dropdown-item" href="{{ route('reportes.index') }}"><i class="fas fa-triangle-exclamation me-1"></i> Ver Actividades Ilegales</a></li>
                                    <li><a class="dropdown-item" href="{{ route('enfermedades.index') }}"><i class="fas fa-virus me-1"></i> Enfermedades de Plantas</a></li>
                                    <li><a class="dropdown-item" href="{{ route('nuevos.index') }}"><i class="fas fa-lightbulb me-2 text-dark"></i> Ver recomendaciones de secciones</a></li>
                                @endif

                                @if(Auth::user()->role === 'user')
                                    <li><a class="dropdown-item" href="{{ route('UsuarioPost.create') }}"><i class="fas fa-plus-circle me-1"></i> Crear Publicación</a></li>
                                    <li><a class="dropdown-item" href="{{ route('reportes.create') }}"><i class="fas fa-triangle-exclamation me-1"></i> Reportar Actividad Ilegal</a></li>
                                    <li><a class="dropdown-item" href="{{ route('nuevos.create') }}"><i class="fas fa-lightbulb me-2 text-warning"></i> Recomendaciones de Secciones Nuevas</a></li>
                                @endif

                                <li><a class="dropdown-item" href="{{ route('eventos.index') }}"><i class="fas fa-calendar-alt me-2"></i> Eventos</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fas fa-user me-1"></i> Mi perfil</a></li>
                                <li><a class="dropdown-item" href="{{ route('usuarios.explorar') }}"><i class="fas fa-users me-1"></i> Explorar Usuarios</a></li>

                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            @endauth
                        </ul>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</nav>

<!-- Estilos responsivos -->
<style>
    .navbar-nav .nav-link {
        padding: 0.5rem 1rem;
        white-space: nowrap;
    }

    .navbar-nav .fa-lg {
        font-size: 1.5rem;
    }

    @media (max-width: 768px) {
        .navbar-nav .nav-item {
            text-align: center;
        }

        .navbar-nav .nav-link {
            padding: 10px;
        }

        .navbar .input-group {
            width: 100% !important;
            margin-top: 8px;
            margin-bottom: 8px;
        }

        .navbar-collapse {
            padding-top: 10px;
            background-color: #198754;
        }

        .navbar .form-control {
            font-size: 14px;
        }

        .navbar .btn-outline-light {
            padding: 0.25rem 0.5rem;
        }

        .navbar .dropdown-menu {
            font-size: 14px;
        }

        .navbar-nav .nav-link i {
            margin-right: 4px;
        }

        .card.h-100.shadow.bg-success {
            background-color: transparent !important;
            box-shadow: none !important;
        }
    }
</style>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

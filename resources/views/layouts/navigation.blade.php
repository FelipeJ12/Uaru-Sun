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
            
            <!-- Menú izquierdo -->
            <ul class="navbar-nav me-auto d-flex align-items-center gap-2">
                @auth
                    @if(Auth::user()->role === 'user' || Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('fauna.index') ? 'active' : '' }}" href="{{ route('fauna.index') }}">
                                <i class="fas fa-paw me-1"></i> Fauna
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('flora.index') ? 'active' : '' }}" href="{{ route('flora.index') }}">
                                <i class="fas fa-leaf me-1"></i> Flora
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('paisajes.index') ? 'active' : '' }}" href="{{ route('paisajes.index') }}">
                                <i class="fas fa-image me-1"></i> Paisajes
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Buscador -->
            <form class="d-flex align-items-center gap-1 me-3 flex-wrap" method="GET" action="{{ route('admin.especies.index') }}">
                <div class="filtro-container position-relative">
                    <input type="hidden" name="filtro" id="filtroSeleccionado" value="{{ request('filtro', 'nombre_comun') }}">
                    <input type="text" class="form-control form-control-sm" name="query" id="campoBusqueda" value="{{ request('query') }}" placeholder="Buscar especie..." style="max-width: 180px;">
                    <div class="filtro-dropdown" id="filtroDropdown">
                        <label><input type="radio" name="filtro_opcion" value="nombre_comun" checked> Nombre Común</label>
                        <label><input type="radio" name="filtro_opcion" value="habitat"> Hábitat</label>
                    </div>
                </div>
                <button class="btn btn-outline-light btn-sm" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>


            <!-- Menú Usuario -->
            <ul class="navbar-nav ms-auto">
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
        <li><a class="dropdown-item" href="{{ route('nuevos.create') }}"><i class="fas fa-lightbulb me-2 text-dark"></i> Recomendaciones de Secciones Nuevas</a></li>
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
                
            </ul>
        </div>
    </div>
</nav>

<style>
    .filtro-dropdown {
        position: absolute;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px 10px;
        z-index: 1000;
        display: none;
    }

    .filtro-dropdown label {
        display: block;
        cursor: pointer;
        margin-bottom: 5px;
    }

    .filtro-container {
        position: relative;
        display: inline-block;
    }
</style>

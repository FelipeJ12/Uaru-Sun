<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="d-inline-block align-text-top" width="40" height="40">
            ÚARU SUN
        </a>

        <!-- Menú Hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Elementos del Menú -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Menú Izquierdo -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    @if(Auth::user()->role === 'user' || Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('fauna.index') ? 'active' : '' }}" href="{{ route('fauna.index') }}">
                                <i class="fas fa-paw me-1"></i> Fauna
                            </a>
                        </li>
                    @endif


                    @if(Auth::user()->role === 'user' || Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('flora.index') ? 'active' : '' }}" href="{{ route('flora.index') }}">
                                <i class="fas fa-leaf me-1"></i> Flora
                            </a>
                        </li>
                    @endif


                    @if(Auth::user()->role === 'user' || Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('paisajes.index') ? 'active' : '' }}" href="{{ route('paisajes.index') }}">
                                <i class="fas fa-image me-1"></i>Paisajes
                            </a>
                        </li>
                    @endif

                @endauth
            </ul>
            
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

<form class="d-flex align-items-center gap-1 ms-2 flex-wrap" method="GET" action="{{ route('admin.especies.index') }}">
    <div class="filtro-container">
        <input type="hidden" name="filtro" id="filtroSeleccionado" value="{{ request('filtro', 'nombre_comun') }}">
        <input type="text" class="form-control form-control-sm" name="query" id="campoBusqueda" value="{{ request('query') }}" placeholder="Buscar especie..." style="max-width: 160px;">
        <div class="filtro-dropdown" id="filtroDropdown">
            <label><input type="radio" name="filtro_opcion" value="nombre_comun" checked> Nombre Común</label>
            <label><input type="radio" name="filtro_opcion" value="habitat"> Hábitat</label>
        </div>
    </div>
    <button class="btn btn-outline-light btn-sm" type="submit">🔍</button>
</form>







            <!-- Menú Derecho -->
            <ul class="navbar-nav ms-auto">

            <!-- Dropdown de Usuario -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('login', 'admin.especies.index', 'UsuarioPost.create', 'profile.index') ? 'active' : '' }}" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle me-1"></i>
                    @auth {{ Auth::user()->name }} @else Menú @endauth
                </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            @guest
            <li>
                <a class="dropdown-item {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt me-1"></i> Ingresar
                </a>
            </li>
            @endguest

            @auth
            @if(Auth::user()->role === 'admin')
                <li>
                    <a class="dropdown-item {{ request()->routeIs('admin.especies.index') ? 'active' : '' }}" href="{{ route('admin.especies.index') }}">
                        <i class="fas fa-cog me-1"></i> Administrar Publicaciones
                    </a>
                </li>
            @endif


            <?php if(Auth::user()->role === 'user'): ?>
            <li>
                <a class="dropdown-item <?php echo e(request()->routeIs('UsuarioPost.create') ? 'active' : ''); ?>" href="<?php echo e(route('UsuarioPost.create')); ?>">
                    <i class="fas fa-plus-circle me-1"></i> Crear Publicación
                </a>
            </li>
            <?php endif; ?>

<?php if(in_array(Auth::user()->role, ['user', 'admin'])): ?>
    <li>
        <a class="dropdown-item <?php echo e(request()->routeIs('profile.index') ? 'active' : ''); ?>" href="<?php echo e(route('profile.index')); ?>">
            <i class="fas fa-user me-1"></i> Mi perfil
        </a>
    </li>
<?php endif; ?>

<?php if(in_array(Auth::user()->role, ['user', 'admin'])): ?>
    <li>
        <a class="dropdown-item <?php echo e(request()->routeIs('usuarios.explorar') ? 'active' : ''); ?>" href="<?php echo e(route('usuarios.explorar')); ?>">
            <i class="fas fa-users me-1"></i> Explorar Usuarios
        </a>
    </li>
<?php endif; ?>



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
</li>

            </ul>
        </div>
    </div>
</nav>
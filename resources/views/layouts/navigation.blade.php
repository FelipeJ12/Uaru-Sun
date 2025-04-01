<!-- resources/views/layouts/navigation.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="d-inline-block align-text-top" width="40" height="40">
            ÚARU SUN
        </a>
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="d-inline-block align-text-top" width="40" height="40">

    </a>


        <!-- Menú Hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Elementos del Menú -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Menú Izquierdo -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i>Inicio
                    </a>
                </li>


                @auth
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.especies.index') ? 'active' : '' }}" href="{{ route('admin.especies.index') }}">
                                <i class="fas fa-cog me-1"></i>Administrar Publicaciones
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->role === 'user')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('UsuarioPost.create') ? 'active' : '' }}" href="{{ route('UsuarioPost.create') }}">
                                <i class="fas fa-plus-circle me-1"></i>Crear Publicación
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->role === 'user' || Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('paisajes.index') ? 'active' : '' }}" href="{{ route('paisajes.index') }}">
                                <i class="fas fa-plus-circle me-1"></i>Paisajes
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->role === 'user' || Auth::user()->role === 'user')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('favoritos.index') ? 'active' : '' }}" href="{{ route('favoritos.index') }}">
                                <i class="fas fa-plus-circle me-1"></i>Favoritos
                            </a>
                        </li>
                    @endif
                @endauth

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.index') }}">Mi Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('store.index') }}">Tienda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('course.index') }}">Cursos</a>
                </li>

            </ul>

           <!-- Menú Derecho -->
<ul class="navbar-nav ms-auto">
    @guest
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt me-1"></i>Ingresar
            </a>
        </li>
    @endguest

    @auth
        <!-- Menú desplegable de opciones -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bars me-1"></i>Menú
            </a>
            <div class="dropdown-menu" aria-labelledby="menuDropdown">
                <a class="dropdown-item" href="{{ route('fauna.index') }}">
                    <i class="fas fa-paw me-2"></i>Fauna
                </a>
                <a class="dropdown-item" href="{{ route('peligro.index') }}">
                    <i class="fas fa-paw me-2"></i>Peligro de Extincion
                </a>
                <a class="dropdown-item" href="{{ route('comidas.index') }}">
                    <i class="fas fa-paw me-2"></i>Alimentación herbívoros
                </a>
                <a class="dropdown-item" href="{{ route('peligrosos.index') }}">
                    <i class="fas fa-paw me-2"></i>Animales peligrosos
                </a>
            </div>
        </li>

        <!-- Dropdown Usuario -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <hr class="dropdown-divider">
                <i class="fas fa-sign-out-alt me-2">
                    <a class="dropdown-item" href="{{ route('informacion.create') }}">
                        <i class="fas fa-paw me-2"></i>Datos del usuario
                    </a>
                </i>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                    </button>
                </form>
            </div>
        </li>
    @endauth
</ul>





            </ul>
        </div>
    </div>
</nav>



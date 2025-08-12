@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('images/fonds.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', sans-serif;
    }

    .overlay-container {
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .header-box {
        background: linear-gradient(to right, rgb(8, 57, 10), #81c784);
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .header-box h2 {
        margin: 0;
    }

    .btn-back {
        position: fixed;
        top: 90px;
        left: 10px;
        background-color: #388e3c;
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        font-weight: bold;
    }

    .btn-back:hover {
        background-color: rgb(5, 57, 8);
        color: white;
    }

    .table-custom {
        background-color: rgba(255, 255, 255, 0.3) !important;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(4px);
    }

    .table td {
        background-color: rgba(122, 164, 124, 0.8);
        color: #fff;
        white-space: nowrap;
    }

    .table th {
        background-color: rgba(44, 183, 51, 0.8);
        color: #003300;
    }

    @media (max-width: 576px) {
        .overlay-container {
            padding: 15px;
        }
        .header-box {
            font-size: 22px;
        }
        .btn-back {
            padding: 8px 15px;
            font-size: 14px;
            position: fixed;
            top: 15px;
            left: 15px;
            width: auto;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table th, .table td {
            font-size: 14px;
            padding: 8px 10px;
            white-space: nowrap;
        }
    }

    .search-form {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .search-input {
        padding: 10px 18px;
        border-radius: 9999px;
        border: 1px solid #2cb733;
        font-size: 16px;
        width: 280px;
        outline: none;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        font-family: 'Segoe UI', sans-serif;
    }
    .search-input:focus {
        border-color: #4ce4a0;
        box-shadow: 0 0 8px #4ce4a0;
    }
</style>

<div class="container mt-5">
    <div class="overlay-container">

        <div class="header-box">
            <h2><i class="fas fa-leaf icon-leaf"></i> Lista de Usuarios Suscritos</h2>
        </div>

        <a href="{{ url()->previous() }}" class="btn-back mb-3 d-inline-block">
            <i class="fas fa-arrow-left me-1"></i> Regresar
        </a>

        <div class="table-responsive table-custom">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha de suscripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                      onsubmit="return confirm('¿Seguro que deseas eliminar al usuario {{ $user->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-white">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    function validarBusqueda() {
        const input = document.querySelector('input[name="buscar"]');
        const regex = /^[A-Za-z0-9\s@._-]*$/;
        if (!regex.test(input.value)) {
            Swal.fire({
                icon: 'error',
                title: 'Entrada inválida',
                text: 'Solo se permiten letras, números, espacios, puntos, guiones y @ en la búsqueda.',
                confirmButtonColor: '#16a34a',
            });
            input.focus();
            return false;
        }
        return true;
    }

    function confirmarEliminacion(event) {
        event.preventDefault();

        const checkboxes = document.querySelectorAll('input[name="ids[]"]:checked');
        if (checkboxes.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No seleccionaste usuarios',
                text: 'Por favor selecciona al menos un usuario para eliminar.',
                confirmButtonColor: '#16a34a',
            });
            return false;
        }

        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará los usuarios seleccionados y no se podrá revertir.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#16a34a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });

        return false;
    }

    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(cb => cb.checked = source.checked);
    }
</script>
@endsection

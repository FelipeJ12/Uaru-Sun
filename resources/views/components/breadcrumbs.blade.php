{{-- resources/views/components/breadcrumbs.blade.php --}}
@props(["items" => [], "title" => null])

<style>
    /* Estilos para breadcrumb tipo flechas */
    .breadcrumb-arrow {
        display: flex;
        flex-wrap: nowrap;
        list-style: none;
        background: none;
        padding: 0;
        margin: 0;
        font-size: 0.9rem;
    }

    .breadcrumb-arrow li {
        position: relative;
        background: #e6f4ea;
        color: #2f855a; /* verde */
        padding: 0.5rem 1.5rem 0.5rem 2rem;
        cursor: pointer;
        font-weight: 600;
        border-radius: 4px;
        transition: background-color 0.3s ease;
        display: flex;
        align-items: center;
    }

    /* Espacio entre cajas */
    .breadcrumb-arrow li + li {
        margin-left: 12px;
    }

    /* Flecha entre elementos */
    .breadcrumb-arrow li:not(:last-child)::after {
        content: "";
        position: absolute;
        top: 50%;
        right: -10px; /* flecha más cerca del borde */
        transform: translateY(-50%) rotate(45deg);
        width: 20px;
        height: 20px;
        background: inherit; /* mismo color que la caja */
        border-top-right-radius: 4px;
        z-index: 2;
        transition: background-color 0.3s ease;
    }

    /* Hover */
    .breadcrumb-arrow li:hover:not(.active) {
        background-color: #c6eccb;
    }
    .breadcrumb-arrow li:hover:not(.active)::after {
        background-color: #c6eccb;
    }

    /* Activo */
    .breadcrumb-arrow li.active {
        background: #2f855a;
        color: white;
        cursor: default;
    }
    .breadcrumb-arrow li.active::after {
        content: none;
    }

    .breadcrumb-arrow a {
        color: inherit;
        text-decoration: none;
        display: block;
    }
</style>

<div class="mb-4 mt-5">
    @if($title)
        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
            <h2 class="h4 mb-0 text-success fw-semibold">{{ $title }}</h2>
        </div>
    @endif

    <nav aria-label="breadcrumb" class="bg-white rounded shadow-sm p-3">
        <ol class="breadcrumb-arrow">
            @foreach($items as $index => $item)
                @php $isLast = $index === array_key_last($items); @endphp

                @if(is_array($item))
                    @php $label = $item['label']; $url = $item['url'] ?? null; @endphp
                @else
                    @php $label = $item; $url = null; @endphp
                @endif

                @if(!$isLast && $url)
                    <li class="breadcrumb-item">
                        <a href="{{ $url }}" class="text-decoration-none">{{ $label }}</a>
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>

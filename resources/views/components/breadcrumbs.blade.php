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
        padding: 0.5rem 1rem 0.5rem 2rem;
        margin-right: 0.5rem;
        cursor: pointer;
        font-weight: 600;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }
    .breadcrumb-arrow li:not(:last-child) {
        margin-right: 0.75rem;
    }
    .breadcrumb-arrow li:not(:last-child)::after {
        content: "";
        position: absolute;
        top: 50%;
        right: -20px;
        transform: translateY(-50%) rotate(45deg);
        width: 15px;
        height: 15px;
        background: #e6f4ea;
        border-top-right-radius: 4px;
        box-shadow: 1px -1px 0 0 white;
        z-index: 1;
        transition: background-color 0.3s ease;
    }
    .breadcrumb-arrow li:hover:not(.active) {
        background-color: #c6eccb;
    }
    .breadcrumb-arrow li:hover:not(.active)::after {
        background-color: #c6eccb;
    }
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
                @php 
                    $isLast = $index === array_key_last($items);
                    if (is_array($item)) {
                        $label = $item['label'];
                        $url = $item['url'] ?? null;
                    } else {
                        $label = $item;
                        $url = null;
                    }
                @endphp

                <li class="{{ $isLast ? 'active' : '' }}" {{ $isLast ? 'aria-current=page' : '' }}>
                    @if(!$isLast && $url)
                        <a href="{{ $url }}">{{ $label }}</a>
                    @else
                        {{ $label }}
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
</div>

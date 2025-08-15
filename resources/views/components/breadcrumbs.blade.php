

{{-- resources/views/components/breadcrumbs.blade.php --}}
@props(["items" => [], "title" => null])

<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

<style>
    .breadcrumb-modern {
        display: flex;
        flex-wrap: wrap;
        list-style: none;
        padding: 0;
        margin: 0;
        background: transparent;
    }
    .breadcrumb-modern li {
        display: flex;
        align-items: center;
        position: relative;
    }
    .breadcrumb-modern li a,
    .breadcrumb-modern li.active {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background-color: rgba(47, 133, 90, 0.12);
        color: #2f855a;
        font-weight: 500;
        border-radius: 999px;
        text-decoration: none;
        font-size: 0.95rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        transition: all 0.25s ease-in-out;
    }
    .breadcrumb-modern li a:hover {
        background-color: rgba(47, 133, 90, 0.25);
        box-shadow: 0 3px 8px rgba(0,0,0,0.12);
        transform: translateY(-1px);
    }
    .breadcrumb-modern li.active {
        background-color: #2f855a;
        color: white;
        cursor: default;
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    }
    .breadcrumb-modern li + li::before {
        content: "\f105";
        font-family: FontAwesome;
        color: #aaa;
        margin: 0 0.6rem;
        font-size: 0.9rem;
    }
    .breadcrumb-modern li .icon {
        font-size: 1rem;
    }
    .breadcrumb-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.8rem;
        border-bottom: 2px solid rgba(47, 133, 90, 0.15);
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
    }
    .breadcrumb-header h2 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 600;
        color: #2f855a;
    }
</style>

<div class="mb-4 mt-5">
    @if($title)
        <div class="breadcrumb-header">
            <h2>{{ $title }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb-modern">
                    @foreach($items as $item)
                        @php
                            $label = $item['label'];
                            $url = $item['url'] ?? null;
                            $icon = $item['icon'] ?? null;
                            $isActive = $url && request()->url() === $url;
                        @endphp

                        @if($isActive)
                            <li class="active">
                                @if($icon)<span class="icon {{ $icon }}"></span>@endif
                                <span>{{ $label }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}">
                                    @if($icon)<span class="icon {{ $icon }}"></span>@endif
                                    <span>{{ $label }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        </div>
    @endif
</div>



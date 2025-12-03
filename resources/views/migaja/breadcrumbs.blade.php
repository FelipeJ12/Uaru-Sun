@props(['links' => []])

<nav aria-label="breadcrumb" style="margin-bottom: 15px;">
    <ol class="breadcrumb" style="background: transparent; padding: 0;">
        @foreach($links as $label => $url)
            @if ($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $url }}" style="text-decoration: none; color: #007bff;">
                        {{ $label }}
                    </a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>

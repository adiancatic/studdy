@php
    $classes = [
        "dropdown-item" => isset($type) && $type === "action",
        "dropdown-item-text" => isset($type) && $type === "info",
    ];
@endphp

<li {{ $attributes->class($classes)->except("type") }}>
    @if(isset($type) && $type === "divider")
        <hr class="dropdown-divider">
    @else
        {{ $slot }}
    @endif
</li>

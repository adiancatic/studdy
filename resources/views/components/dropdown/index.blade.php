@php
    $menuClasses = [
        "dropdown-menu",
        "dropdown-menu-start" => isset($align) && $align === "start",
        "dropdown-menu-end" => isset($align) && $align === "end",
    ];
@endphp

<div {{ $attributes->class("dropdown")->except("align") }}>
    <button class="dropdown-btn" type="button" data-bs-toggle="dropdown">
        {{ $toggle }}
    </button>
    <ul @class($menuClasses)>
        {{ $slot }}
    </ul>
</div>

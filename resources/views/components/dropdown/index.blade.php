@php
    $menuClasses = [
        "dropdown-menu",
        "dropdown-menu-start" => isset($align) && $align === "start",
        "dropdown-menu-end" => isset($align) && $align === "end",
    ];

    $toggleClasses = [
        "dropdown-btn",
        $toggle->attributes->get("class"),
    ];
@endphp

<div {{ $attributes->class("dropdown")->except("align") }}>
    <button {{ $attributes->class($toggleClasses) }} type="button" data-bs-toggle="dropdown">
        {{ $toggle }}
    </button>
    <ul {{ $attributes->class($menuClasses) }}>
        {{ $slot }}
    </ul>
</div>

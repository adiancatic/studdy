@php
    $componentClasses = [
        "dropdown",
        "btn-group" => isset($btnGroup),
    ];

    $menuClasses = [
        "dropdown-menu",
        "dropdown-menu-start" => isset($align) && $align === "start",
        "dropdown-menu-end" => isset($align) && $align === "end",
    ];

    $toggleClasses = [
        "dropdown-btn",
        "dropdown-toggle" => isset($btnGroup),
        $toggle->attributes->get("class"),
    ];
@endphp

<div {{ $attributes->class($componentClasses)->except(["align", "btnGroup"]) }}>
    <button {{ $attributes->class($toggleClasses) }} type="button" data-bs-toggle="dropdown">
        {{ $toggle }}
    </button>
    <ul {{ $attributes->class($menuClasses) }}>
        {{ $slot }}
    </ul>
</div>

<div class="progress-line">
    <div
        class="progress-line__container"
        @isset($tooltip)
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            data-bs-title="{{ __($tooltip) }}"
        @endisset
    >
        <span class="progress-line__outer">
            <span class="progress-line__inner" style="width: {{ $percentage() }}%"></span>
        </span>
        <span class="progress-line__number">
            {{ number_format($actual, 1, ",", ".") }}
        </span>
    </div>
</div>

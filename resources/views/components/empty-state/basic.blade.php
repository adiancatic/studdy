<div class="empty-state--basic">
    @if($icon)
        <div class="empty-state__icon">
            <i class="fal fa-{{ $icon }}"></i>
        </div>
    @endif

    @if($title)
        <h4 class="empty-state__title">{{ $title }}</h4>
    @endif

    @if($subtitle)
        <h5 class="empty-state__subtitle">{{ $subtitle }}</h5>
    @endif

    @if($description)
        <div class="empty-state__description">{{ $description }}</div>
    @endif

    @if($ctas)
        <div class="empty-states__ctas">
            @foreach($ctas as $cta)
                {{ $cta }}
            @endforeach
        </div>
    @endif
</div>

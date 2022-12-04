@if($getSegments())
    <div class="breadcrumbs">
        @foreach($getSegments() as $segment)

            @if(! $loop->last)
                <a href="{{ $segment->getUrl() }}" class="breadcrumbs__cta">{{ $segment->getTitle() }}</a>
            @else
                <span class="breadcrumbs__txt">{{ $segment->getTitle() }}</span>
            @endif

            @if(! $loop->last)
                <span class="breadcrumbs__divider">
                    <i class="fal fa-chevron-right"></i>
                </span>
            @endif
        @endforeach
    </div>
@endif

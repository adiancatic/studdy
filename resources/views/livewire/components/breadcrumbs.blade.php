<div class="breadcrumbs">
    @php
        $url = "";
    @endphp

    @foreach($breadcrumbs as $breadcrumb)

        @php
            $title = "";
            if (isset($breadcrumb->breadcrumbConf()["item"])) {
                $title = $breadcrumb->{$breadcrumb->breadcrumbConf()["item"]}->title;
            } elseif (isset($breadcrumb->breadcrumbConf()["title"])) {
                $title = $breadcrumb->breadcrumbConf()["title"];
            }

            $url .= "/";
            if (isset($breadcrumb->breadcrumbConf()["item"])) {
                $url .= $breadcrumb->{$breadcrumb->breadcrumbConf()["item"]}->id;
            } elseif (isset($breadcrumb->breadcrumbConf()["urlSegment"])) {
                $url .= $breadcrumb->breadcrumbConf()["urlSegment"];
            }

        @endphp

        @if(! $loop->last)
            <a href="{{ $url }}" class="breadcrumbs__cta">{{ $title }}</a>
        @else
            <span class="breadcrumbs__txt">{{ $title }}</span>
        @endif

        @if(! $loop->last)
            <span class="breadcrumbs__divider">
                <i class="fal fa-chevron-right"></i>
            </span>
        @endif

    @endforeach
</div>

@php
    $titleClasses = [
        "item-list__item-title",
        "is-untitled" => $model->title === __("Untitled"),
    ];
@endphp

<div class="item-list__item" data-id="{{ $model->id }}" @if($isSortable) wire:sortable.item="{{ $model->id }}" @endif>
    @if($isSortable)
        <span class="item-list__item-handle" wire:sortable.handle></span>
    @endif

    <div class="item-list__item-actions">
        <span class="item-list__item-index">{{ $index }}</span>
        @if($dropdown)
            {!! $dropdown !!}
        @else
            <x-dropdown>
                <x-slot:toggle>
                    <i class="far fa-fw fa-ellipsis-v"></i>
                </x-slot:toggle>

                <x-dropdown.item type="action">
                    <button type="button" wire:click="confirmAndDelete">
                        <i class="far fa-fw fa-trash"></i>{{ __("Delete") }}
                    </button>
                </x-dropdown.item>
            </x-dropdown>
        @endif
    </div>

    <div class="item-list__item-title-container">
        <span @class($titleClasses) onclick="editTitle(this)">{{ $model->title }}</span>
        @if($showCta)
            <a class="btn btn-default btn-xs item-list__item-cta" href="{{ $model->url }}">{{ $cta ?: __("Open") }}</a>
        @endif
    </div>

    <span class="item-list__item-date"><i class="far fa-calendar"></i>{{ $model->created_at->format('d M Y') }}</span>

    <span class="item-list__item-author">{{ $model->author }}</span>
</div>

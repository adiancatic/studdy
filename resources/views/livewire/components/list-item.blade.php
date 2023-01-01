@php
    $titleClasses = [
        "item-list__item-title",
        "is-untitled" => $item->title === __("Untitled"),
    ];
@endphp

<div class="item-list__item" data-id="{{ $item->id }}" @if($isSortable) wire:sortable.item="{{ $item->id }}" @endif>
    @if($isSortable)
        <span class="item-list__item-handle" wire:sortable.handle></span>
    @endif

    <div class="item-list__item-actions">
        <span class="item-list__item-index">{{ $index }}</span>
        <x-dropdown>
            <x-slot:toggle>
                <i class="far fa-fw fa-ellipsis-v"></i>
            </x-slot:toggle>

            <x-dropdown.item type="action">
                <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $index }}">
                    <i class="far fa-fw fa-trash"></i>{{ __("Delete") }}
                </a>
            </x-dropdown.item>
        </x-dropdown>
    </div>

    <div class="item-list__item-title-container">
        <span @class($titleClasses) onclick="editTitle(this)">{{ $item->title }}</span>
        <a class="btn btn-default btn-xs item-list__item-cta" href="{{ $item->url }}">{{ __("Open") }}</a>
    </div>

    <span class="item-list__item-date"><i class="far fa-calendar"></i>{{ $item->created_at->format('d M Y') }}</span>

    <span class="item-list__item-author">{{ $item->author }}</span>

    <div wire:ignore.self class="modal fade" id="deleteModal-{{ $index }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete <strong>{{ $item->title }}</strong>?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" wire:click.prevent="delete" data-bs-dismiss="modal" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>

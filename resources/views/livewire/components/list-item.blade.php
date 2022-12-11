@php
    $titleClasses = [
        "item-list__item-title",
        "is-untitled" => $title === __("Untitled"),
    ];
@endphp

<div class="item-list__item" data-id="{{ $itemId }}" wire:sortable.item="{{ $itemId }}">
    <span class="item-list__item-handle" wire:sortable.handle></span>
    <div class="item-list__item-actions">
        <span class="item-list__item-index">{{ $index }}</span>
        <x-dropdown>
            <x-slot:toggle>
                <i class="far fa-fw fa-ellipsis-v"></i>
            </x-slot:toggle>

            <x-dropdown.item type="action">
                <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $index }}">
                    <i class="fas fa-fw fa-trash"></i>{{ __("Delete") }}
                </a>
            </x-dropdown.item>
        </x-dropdown>
    </div>
    <div class="item-list__item-title-container">
        <span @class($titleClasses) onclick="editTitle(this)">{{ $title }}</span>
        <a class="btn btn-default btn-xs item-list__item-cta" href="{{ $url }}">{{ __("Open") }}</a>
    </div>
    <span class="item-list__item-date"><i class="far fa-calendar"></i>{{ $date }}</span>
    <span class="item-list__item-author">{{ $author }}</span>


    <div wire:ignore.self class="modal fade" id="deleteModal-{{ $index }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete <strong>{{ $title }}</strong>?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" wire:click.prevent="$emit('deleteItem', {{ $itemId }})" data-bs-dismiss="modal" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>

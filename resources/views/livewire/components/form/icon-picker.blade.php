<div class="form-icon-picker">
    <input type="hidden" name="icon" wire:model="icon">

    <x-dropdown wire:ignore.self>
        <x-slot:toggle class="btn btn-md btn-default">
            @if($icon !== null)
                <i class="fas fa-fw fa-{{ $icon }}"></i>
            @endif
            <span>{{ __("Icon") }}</span>
            <i class="far fa-chevron-down"></i>
        </x-slot:toggle>

        <x-dropdown.item type="text" class="icon-search">
            <input wire:model.debounce.300ms="search" type="search" placeholder="{{ __('Search') }}">
        </x-dropdown.item>

        <x-dropdown.item type="text" class="icon-list">
            @foreach($icons as $iconName)
                <button
                    type="button"
                    wire:click="$set('icon', '{{ $iconName }}')"
                    @if($iconName === $icon) class="selected" @endif
                >
                    <i class="fas fa-fw fa-{{ $iconName }}"></i>
                </button>
            @endforeach
        </x-dropdown.item>

        <x-dropdown.item type="text" class="load-more"></x-dropdown.item>
    </x-dropdown>

    <script>
        document.addEventListener("livewire:load", () => {
            let iconPicker = document.querySelector(".form-icon-picker");

            let observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        @this.loadIcons()
                    }
                })
            }, {
                root: iconPicker.querySelector(".dropdown-menu"),
                rootMargin: '0px',
                threshold: 1,
            })

            observer.observe(
                iconPicker.querySelector(".load-more")
            )
        })
    </script>
</div>

<nav class="nav-sidebar">
    <div class="nav-sidebar__header">
        <a class="nav-sidebar__logo" href="{{ url('/') }}">
            <img class="logo"
                 src="{{ asset('assets/logo.png') }}"
                 srcset="{{ asset('assets/logo.png') }} 1x, {{ asset('assets/logo@2x.png') }} 2x"
                 alt="{{ config('app.name') }}">
        </a>

        <x-dropdown align="end" class="nav-sidebar__user">
            <x-slot name="toggle">
                <x-user-avatar/>
            </x-slot>

            <x-dropdown.item type="info" class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-email">{{ Auth::user()->email }}</div>
            </x-dropdown.item>

            <x-dropdown.item type="divider" />

            <x-dropdown.item type="action">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-door-open"></i>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </x-dropdown.item>
        </x-dropdown>

    </div>

    @if($this::VIEWS)
        <ul class="nav-sidebar__modules">
            @foreach($this::getViews() as $view)
                @php
                    $classes = [
                        "nav-sidebar__module-item-anchor",
                        "is-active" => $this::TEMP_URL_MAP[$view::class] === $this->getActiveView(),
                    ];
                @endphp

                <li class="nav-sidebar__module-item">
                    <a href="/{{ $this::TEMP_URL_MAP[$view::class] }}" @class($classes)>
                        <i class="nav-sidebar__module-item-icon fa-fw fas fa-{{ $view->getIcon() }}"></i>
                        <span class="nav-sidebar__module-item-title">{{ $view->getTitle() }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</nav>

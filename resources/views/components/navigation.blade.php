<nav class="nav-sidebar">
    <div class="nav-sidebar__header">
        <a class="nav-sidebar__logo" href="{{ url('/') }}">
            <img class="logo"
                 src="{{ asset('assets/logo.png') }}"
                 srcset="{{ asset('assets/logo.png') }} 1x, {{ asset('assets/logo@2x.png') }} 2x"
                 alt="{{ config('app.name') }}">
        </a>
        <div class="nav-sidebar__user">

            <x-dropdown>
                <x-slot:toggle>
                    <x-user-avatar/>
                </x-slot>

                <ul class="dropdown-section">
                    <li class="dropdown-item dropdown-info">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-email">{{ Auth::user()->email }}</div>
                    </li>
                </ul>
                <ul class="dropdown-section">
                    <li class="dropdown-item dropdown-action">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-door-open"></i>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                </ul>
            </x-dropdown>

        </div>
    </div>

    @if(\App\View\Components\Navigation::COMPOSERS)
        <ul class="nav-sidebar__modules">
            @foreach(\App\View\Components\Navigation::getComposers() as $composer)
                <li class="nav-sidebar__module-item">
                    <a href="{{ \App\View\Components\Navigation::TEMP_URL_MAP[$composer::class] }}" class="nav-sidebar__module-item-anchor">
                        <i class="nav-sidebar__module-item-icon fa-fw fas fa-{{ $composer->getIcon() }}"></i>
                        <span class="nav-sidebar__module-item-title">{{ $composer->getTitle() }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</nav>

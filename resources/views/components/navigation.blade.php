<nav class="nav-sidebar">
    <div class="nav-sidebar__header">

        <a class="nav-sidebar__logo" href="{{ url('/') }}">
            <img class="logo"
                 src="{{ asset('assets/logo.png') }}"
                 srcset="{{ asset('assets/logo.png') }} 1x, {{ asset('assets/logo@2x.png') }} 2x"
                 alt="{{ config('app.name') }}">
        </a>

        <div class="nav-sidebar__user">
            {{ Auth::user()->name }}
            <div class="user-dropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        @if(\App\View\Components\Navigation::COMPOSERS)
            <ul class="nav-sidebar__modules">
                @foreach(\App\View\Components\Navigation::getComposers() as $composer)
                    <li class="nav-sidebar__module-item">
                        <i class="fa-fw fas fa-{{ $composer->getIcon() }}"></i>
                        <span class="nav-sidebar__module-item-title">{{ $composer->getTitle() }}</span>
                    </li>
                @endforeach
            </ul>
        @endif

    </div>
</nav>

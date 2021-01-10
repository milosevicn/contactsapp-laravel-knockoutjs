<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <nav class="my-2 my-md-0 me-md-3">
        <span class="h5 my-0 me-md-auto fw-normal">Contacts App</span>        
        @if (Route::has('login'))
            @auth
            <x-dropdown-link :href="route('logout')" class="p-2 text-dark"
                        onclick="event.preventDefault();
                                    document.getElementById('logout_form').submit();">
                    {{ __('Logout') }}
                </x-dropdown-link>
                <form id="logout_form" method="post" action="{{ route('logout') }}">@csrf</form>
            @else
                <a href="{{ route('login') }}" class="p-2 text-dark">Login</a>
            @endauth
        @endif
    </nav>
</header>
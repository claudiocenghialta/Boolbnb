<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm text-primary">
    <div class="container">
        <a class="navbar-brand text-primary" href="{{ url('/') }}">
            <img class="logo" src="{{ asset('/immagini-layout/logo/BoolBnb-navbar.png')}}" alt="Logo BoolBnb">
            Boolbnb
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item text-primary">
                    <a class="nav-link text-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item text-primary">
                    <a class="nav-link text-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown text-primary">
                    <a id="navbarDropdown" class="nav-link text-primary dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Gestione appartamenti
                    </a>

                    <div class="dropdown-menu dropdown-menu-right text-primary" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-primary" href="{{ route('apartments.index') }}">
                            {{ __('I tuoi Appartamenti') }}
                        </a>
                        <a class="dropdown-item text-primary" href="{{ route('apartments.create') }}">
                            {{ __('Aggiungi Appartamento') }}
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown text-primary">
                    <a id="navbarDropdown" class="nav-link text-primary dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Inbox
                    </a>
                    <div class="dropdown-menu dropdown-menu-right text-primary" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-primary" href="{{ route('messages.index') }}">
                            {{ __('Messaggi ricevuti') }}
                        </a>
                        <a class="dropdown-item text-primary" href="{{ route('messages.sent') }}">
                            {{ __('Messaggi inviati') }}
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown text-primary">
                    <a id="navbarDropdown" class="nav-link text-primary dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->nome }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right text-primary" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item text-primary" href="{{ route('users.show',Auth::user()->id ) }}">
                            {{ __('Profilo') }}
                        </a>

                        <a class="dropdown-item text-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

                {{-- prova dropdown --}}
                {{-- <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Inbox
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('messages.index') }}">
                {{ __('Messaggi ricevuti') }}
                </a>
                <a class="dropdown-item" href="{{ route('messages.sent') }}">
                    {{ __('Messaggi inviati') }}
                </a>
        </div>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                Appartamenti
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('apartments.index') }}">
                    {{ __('Gestione Appartamenti') }}
                </a>
                <a class="dropdown-item" href="{{ route('apartments.create') }}">
                    {{ __('Aggiungi Appartamento') }}
                </a>
            </div>
        </li> --}}
        @endguest
        </ul>
    </div>
    </div>
</nav>
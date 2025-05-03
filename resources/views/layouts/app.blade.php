<!DOCTYPE html>
<html>
<head>
    <title>Web Sekolah</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <a class="navbar-brand" href="{{ url('/') }}">Web Sekolah</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item"><a class="nav-link" href="#">{{ auth()->user()->name }}</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
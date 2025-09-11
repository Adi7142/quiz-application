<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz App</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<nav class="navbar">

    <a href="/dashboard">home</a>

    @auth
        <span>Welkom, {{ auth()->user()->name }}</span>

        <!-- Logout form -->
        <form action="{{ route('logout') }}" method="POST" style="display:inline">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    @endauth
</nav>

<main class="container">
    @yield('content')
</main>
</body>
</html>

<html lang="en">
<head>
    <title>Blog Posts</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200">
    <nav class="bg-white flex justify-between mb-3 p-4">
        <ul class="flex flex-row items-center">
            <li class="p-3">
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="p-3">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="p-3">
                <a href="{{ route('posts') }}">Posts</a>
            </li>
        </ul>

        <ul class="flex flex-row items-center">
            @if(auth()->user())
                <li class="p-3">

                    <a href="">{{ json_decode(auth()->user(), true)['username'] }}</a>
                </li>
                <li class="p-3">

                    <form action="{{ route('logout') }}" method="post" class="inline p-3">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>

                </li>
            @else
                <li class="p-3">
                    <a href="{{ route('login') }}">Login</a>
                </li>
                <li class="p-3">
                    <a href="{{ route('Register') }}">Register</a>
                </li>
            @endif
        </ul>
    </nav>
   @yield('content')
</body>
</html>

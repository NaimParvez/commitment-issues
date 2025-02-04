<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'CourseRoadmap') }}</title>
    @vite('resources/css/app.css') <!-- Tailwind CSS via Vite -->
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('roadmap.index') }}" class="text-lg font-bold">Roadmap Generator</a>
            <div>
                <a href="{{ route('roadmap.create') }}" class="px-4">Create</a>
                <a href="{{ route('roadmap.index') }}" class="px-4">My Roadmaps</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4">Logout</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="px-4">Login</a>
                    <a href="{{ route('register') }}" class="px-4">Register</a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="container mx-auto mt-4">
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <div class="container mx-auto mt-8">
        @yield('content')
    </div>

    @vite('resources/js/app.js')
</body>
</html>

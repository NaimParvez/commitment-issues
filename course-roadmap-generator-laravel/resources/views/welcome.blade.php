<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Course Roadmap Generator</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link
      href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
      rel="stylesheet"
    />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
      <style>
        /* Tailwind CSS fallback */
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
      </style>
    @endif

    <!-- Additional Custom Styles -->
    <style>
      /* Custom gradient background for hero section */
      .hero-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      }
      /* Custom card hover effect */
      .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
      }
      .card {
        transition: all 0.3s ease;
      }
    </style>
  </head>
  <body class="font-sans antialiased bg-gray-50 text-gray-800">
    <!-- Hero Section -->
    <header class="hero-bg text-white py-16">
      <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">
          Course Roadmap Generator
        </h1>
        <p class="text-xl md:text-2xl mb-8">
          Plan your future, one step at a time.
        </p>
        <div class="space-x-4">
          <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-md shadow-lg transition duration-300">Log in</a>
          <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-md shadow-lg transition duration-300">Register</a>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12 space-y-8">
      <!-- Welcome Card with a Daily Motivational Quote -->
      @php
        // Array of motivational quotes
        $quotes = [
          "The journey of a thousand miles begins with a single step. – Lao Tzu",
          "Success is not final; failure is not fatal: It is the courage to continue that counts. – Winston Churchill",
          "Don't watch the clock; do what it does. Keep going. – Sam Levenson",
          "The secret of getting ahead is getting started. – Mark Twain",
          "Your future is created by what you do today, not tomorrow. – Robert Kiyosaki",
          "The only limit to our realization of tomorrow is our doubts of today. – Franklin D. Roosevelt",
          "Believe you can and you're halfway there. – Theodore Roosevelt"
        ];
        // Determine a daily quote based on the day of the year
        $dayOfYear = date('z'); // 'z' gives the day of the year (0 through 365)
        $dailyQuote = $quotes[$dayOfYear % count($quotes)];
      @endphp

      <div class="card bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-semibold mb-4">Welcome</h2>
        <p class="text-gray-700 mb-6">
          "{{ $dailyQuote }}"
        </p>
        <p class="text-gray-700">
          Create your roadmap, set your goals, and start your journey toward a brighter future!
        </p>
      </div>

      <!-- How It Works Card -->
      <div class="card bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-semibold mb-4">How It Works</h2>
        <p class="text-gray-700">
          With our intuitive tool, you can create detailed course roadmaps in minutes. Simply input your course details, and our generator will produce a clear, step-by-step guide for you to follow. Whether you're planning a new course or mapping out your learning journey, we're here to help you stay organized and motivated.
        </p>
      </div>

      <!-- Call to Action Card -->
      <div class="card bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-semibold mb-4">Take the First Step</h2>
        <p class="text-gray-700 mb-6">
          "Your future is created by what you do today, not tomorrow." – Robert Kiyosaki
        </p>
        <div class="flex justify-center">
          <a href="{{ route('roadmap.create') }}" class="bg-purple-500 hover:bg-purple-600 text-white px-8 py-3 rounded-md text-lg shadow-lg transition duration-300">
            Create Your Roadmap Now
          </a>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 text-center">
      <p>&copy; {{ date('Y') }} Course Roadmap Generator. All rights reserved.</p>
      <p class="mt-2 text-sm">Empowering you to plan, learn, and succeed.</p>
    </footer>
  </body>
</html>

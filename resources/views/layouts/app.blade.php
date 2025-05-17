<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', config('app.name'))</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
  @include('partials.nav')
  <main class="py-8">
    <div class="max-w-4xl mx-auto px-4">
      @include('partials.alerts')
      @yield('content')
    </div>
  </main>
</body>
</html>

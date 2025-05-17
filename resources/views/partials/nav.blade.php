<nav class="bg-white shadow">
  <div class="max-w-4xl mx-auto px-4 py-3 flex justify-between items-center">
    <a href="{{ route('home') }}" class="text-lg font-bold">{{ config('app.name') }}</a>
    <div>
      @auth
        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button type="submit" class="text-red-600 hover:underline">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        <!-- <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a> -->
      @endauth
    </div>
  </div>
</nav>

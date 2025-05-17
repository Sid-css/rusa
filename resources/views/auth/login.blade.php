<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Login to Your Account</h2>

        @if(session('error'))
            <div class="p-3 text-red-600 bg-red-100 border border-red-200 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 mt-1 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 mt-1 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm text-gray-700">Remember Me</label>
            </div>

            <button type="submit"
                class="w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Login</button>
        </form>
    </div>

</body>
</html>

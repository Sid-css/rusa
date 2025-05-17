@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded shadow">
  <h2 class="text-2xl font-semibold mb-6 text-center">Create an Account</h2>

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-4">
      <label class="block mb-1 font-medium" for="name">Name</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
             class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300">
    </div>

    <div class="mb-4">
      <label class="block mb-1 font-medium" for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required
             class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300">
    </div>

    <div class="mb-4">
      <label class="block mb-1 font-medium" for="password">Password</label>
      <input id="password" type="password" name="password" required
             class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300">
    </div>

    <div class="mb-4">
      <label class="block mb-1 font-medium" for="password_confirmation">Confirm Password</label>
      <input id="password_confirmation" type="password" name="password_confirmation" required
             class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300">
    </div>

    <div class="mb-6">
      <label class="block mb-1 font-medium" for="role">Role</label>
      <select id="role" name="role" required
              class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300">
        <option value="">Select Role</option>
        <option value="admin">Admin</option>
        <option value="institution">Institution</option>
      </select>
    </div>

    <div>
      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
        Register
      </button>
    </div>
  </form>

  <p class="mt-4 text-center text-sm">
    Already have an account?
    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login here</a>.
  </p>
</div>
@endsection

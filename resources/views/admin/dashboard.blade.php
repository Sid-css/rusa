@extends('layouts.app')

@section('content')
<div class="py-6 bg-gray-50 min-h-screen">
  <div class="max-w-4xl mx-auto px-4 space-y-8">

    {{-- Stats Overview --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-start">
        <p class="text-sm text-gray-500 uppercase tracking-wide">Total Institutions</p>
      
      </div>
      <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-start">
        <p class="text-sm text-gray-500 uppercase tracking-wide">Total Institution Users</p>
         
      </div>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
      <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
        {{ session('success') }}
      </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
      <div class="bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
        <ul class="list-disc pl-5 space-y-1">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Add Institution Form --}}
    <div class="bg-white shadow-lg rounded-lg p-6">
      <h2 class="text-2xl font-semibold mb-6 text-gray-800">Add New Institution</h2>
      <form method="POST" action="{{ route('admin.dashboard') }}" class="space-y-6">
        @csrf

        <div>
          <label class="block text-sm font-medium text-gray-700">Institution Name</label>
          <input name="institution_name" value="{{ old('institution_name') }}"
                 class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Description</label>
          <textarea name="description" rows="3"
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Institution Type</label>
          <input name="institution_type" value="{{ old('institution_type') }}"
                 class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Assign Institution Admin (Name)</label>
          <input name="admin_name" value="{{ old('admin_name') }}"
                 class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700">Admin Email</label>
            <input name="admin_email" type="email" value="{{ old('admin_email') }}"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Contact Number</label>
            <input name="contact_number" value="{{ old('contact_number') }}"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Address</label>
          <textarea name="address" rows="2"
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('address') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700">City</label>
            <input name="city" value="{{ old('city') }}"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">State</label>
            <input name="state" value="{{ old('state') }}"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Institution Email</label>
          <input name="institution_email" type="email" value="{{ old('institution_email') }}"
                 class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Institution Code</label>
          <input name="institution_code" value="{{ old('institution_code') }}"
                 class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input name="password" type="password"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input name="password_confirmation" type="password"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
          </div>
        </div>

        <div class="flex items-center">
          <input type="checkbox" name="is_active" value="1"
                 class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                 {{ old('is_active') ? 'checked' : '' }}>
          <label class="ml-2 text-sm font-medium text-gray-700">Is Active?</label>
        </div>

        <button type="submit"
                class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
          Create Institution
        </button>
      </form>
    </div>

  </div>
</div>
@endsection

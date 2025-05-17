@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="mt-10 text-center">
  <h1 class="text-3xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
  <p class="mt-4">You are logged in as <strong>{{ auth()->user()->role }}</strong>.</p>
</div>
@endsection

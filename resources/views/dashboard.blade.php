@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
            <div class="flex items-center">
                @if(Auth::user()->isAdmin())
                <a href="{{ route('institutions.index') }}" class="mr-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Manage Institutions
                </a>
                @endif
                <a href="{{ route('projects.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    Add New Project
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <form action="{{ route('dashboard') }}" method="GET">
                <div class="flex rounded-md shadow-sm">
                    <input type="text" name="search" value="{{ $query ?? '' }}" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-l-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Search schemes, projects or institutions...">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-r-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Stats Overview -->
        <div class="mb-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Schemes</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $schemes->total() }}</dd>
                </div>
            </div>
            
            @if(Auth::user()->isAdmin())
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Institutions</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ \App\Models\Institution::count() }}</dd>
                </div>
            </div>
            @endif
            
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Projects</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ \App\Models\Project::count() }}</dd>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Approved Amount</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">₹{{ number_format(\App\Models\Project::sum('approved_amount'), 2) }}</dd>
                </div>
            </div>
        </div>

        <!-- Schemes Grid -->
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Schemes
                </h3>
            </div>
            
            @if($schemes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                @foreach($schemes as $scheme)
                <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="bg-gray-50 px-4 py-3 border-b">
                        <h3 class="text-lg font-medium text-gray-900 truncate">{{ $scheme->schemeDetail->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $scheme->institution->name }}</p>
                    </div>
                    <div class="px-4 py-3">
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-500">Projects:</span>
                            <span class="text-sm font-medium">{{ $scheme->projects->count() }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-500">Approved Amount:</span>
                            <span class="text-sm font-medium">₹{{ number_format($scheme->getTotalApprovedAmount(), 2) }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-500">Received Amount:</span>
                            <span class="text-sm font-medium">₹{{ number_format($scheme->getTotalReceivedAmount(), 2) }}</span>
                        </div>
                        
                        @php
                            $utilizationPercentage = $scheme->getTotalApprovedAmount() > 0 
                                ? ($scheme->getTotalReceivedAmount() / $scheme->getTotalApprovedAmount()) * 100 
                                : 0;
                        @endphp
                        
                        <div class="mt-3">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-medium text-gray-500">Utilization</span>
                                <span class="text-xs font-medium text-gray-500">{{ number_format($utilizationPercentage, 1) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ min($utilizationPercentage, 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 border-t">
                        <a href="{{ route('schemes.show', $scheme->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">View Details</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 sm:px-6">
                {{ $schemes->withQueryString()->links() }}
            </div>
            @else
            <div class="px-4 py-5 sm:px-6 text-center">
                <p class="text-gray-500">No schemes found. {{ $query ? 'Try a different search term.' : '' }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
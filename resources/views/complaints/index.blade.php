@extends('layouts.app')

@section('title', 'My Complaints')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header Section -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-1">My Complaints</h2>
        <p class="text-sm text-gray-500">Track the status of your reported issues</p>
    </div>

    <!-- Search and Filter Bar -->
    <div class="bg-white rounded-xl border border-gray-200 p-4 mb-6 flex items-center justify-between">
        <div class="flex-1 flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" 
                   placeholder="Search complaints..." 
                   class="flex-1 border-none focus:ring-0 text-sm text-gray-600 placeholder-gray-400">
        </div>
        <button class="p-2 hover:bg-gray-50 rounded-lg transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
        </button>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        
        <!-- Table Header -->
        <div class="grid grid-cols-12 gap-4 px-6 py-4 bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
            <div class="col-span-2">Complaint ID</div>
            <div class="col-span-3">Subject</div>
            <div class="col-span-2">Category</div>
            <div class="col-span-2">Date</div>
            <div class="col-span-2">Status</div>
            <div class="col-span-1 text-center">Action</div>
        </div>

        <!-- Table Body -->
        <div class="divide-y divide-gray-100">
            
            @forelse($complaints as $complaint)
            <!-- Row 1 -->
            <div class="grid grid-cols-12 gap-4 px-6 py-5 hover:bg-gray-50 transition items-center">
                
                <!-- Complaint ID -->
                <div class="col-span-2">
                    <p class="text-sm font-medium text-gray-900">{{ $complaint->complaint_code }}</p>
                </div>

                <!-- Subject with Priority -->
                <div class="col-span-3">
                    <p class="text-sm font-medium text-gray-900 mb-1">{{ $complaint->subject }}</p>
                    @if($complaint->priority === 'high')
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-50 text-red-700">
                            High Priority
                        </span>
                    @elseif($complaint->priority === 'medium')
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-50 text-orange-700">
                            Medium Priority
                        </span>
                    @else
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700">
                            Low Priority
                        </span>
                    @endif
                </div>

                <!-- Category -->
                <div class="col-span-2">
                    <p class="text-sm text-gray-600">{{ ucfirst($complaint->category) }}</p>
                </div>

                <!-- Date -->
                <div class="col-span-2">
                    <p class="text-sm text-gray-600">{{ $complaint->created_at->format('Y-m-d') }}</p>
                </div>

                <!-- Status -->
                <div class="col-span-2">
                    @if($complaint->status === 'pending')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            Pending
                        </span>
                    @elseif($complaint->status === 'in_progress')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            In Progress
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Resolved
                        </span>
                    @endif
                </div>

                <!-- Action -->
                <div class="col-span-1 text-center">
                    <button class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                        </svg>
                    </button>
                </div>

            </div>
            @empty
            <div class="px-6 py-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-gray-500 text-sm">No complaints found</p>
            </div>
            @endforelse

        </div>

        <!-- Pagination Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
            <p class="text-sm text-gray-600">
                Showing 1-3 of 3 results
            </p>
            <div class="flex gap-2">
                <button class="px-3 py-1.5 text-sm text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">
                    Previous
                </button>
                <button class="px-3 py-1.5 text-sm text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">
                    Next
                </button>
            </div>
        </div>

    </div>

</div>

@endsection
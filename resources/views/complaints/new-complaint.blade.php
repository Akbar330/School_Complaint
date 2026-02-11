@extends('layouts.app')

@section('title', 'New Complaint')

@section('content')

<div class="max-w-4xl mx-auto">

    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Submit a Complaint</h2>
        <p class="text-sm text-gray-500">Fill out the form below to report an issue. Your privacy is important to us.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl border border-gray-200 p-8">
        
        <form action="{{ route('complaints.store') }}" method="POST">
            @csrf

            <!-- Category & Urgency Level (2 columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <!-- Category -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Category
                    </label>
                    <select name="category" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">Select Category</option>
                        <option value="facilities">Facilities</option>
                        <option value="cafeteria">Cafeteria</option>
                        <option value="academics">Academics</option>
                        <option value="bullying">Bullying</option>
                        <option value="other">Other</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Urgency Level -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Urgency Level
                    </label>
                    <select name="priority" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="low">Low - Can wait a week</option>
                        <option value="medium">Medium - Needs attention soon</option>
                        <option value="high">High - Urgent issue</option>
                    </select>
                    @error('priority')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Subject -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Subject
                </label>
                <input type="text" 
                       name="subject"
                       placeholder="Brief summary of the issue"
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                @error('subject')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Detailed Description -->
            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Detailed Description
                </label>
                <textarea name="description" 
                          rows="8"
                          placeholder="Please provide as much detail as possible..."
                          class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"></textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('complaints.index') }}" 
                   class="px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition shadow-sm">
                    Submit Complaint
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
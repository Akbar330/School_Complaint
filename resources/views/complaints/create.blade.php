@extends('layouts.app')

@section('content')

    <h1 class="text-2xl font-bold mb-6">New Complaint</h1>
    @if ($errors->any())
        <div class="bg-red-100 p-3">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('complaints.store') }}" class="bg-white p-6 rounded-xl shadow space-y-4">
        @csrf

        <input type="text" name="subject" placeholder="Subject" class="w-full border p-2 rounded">

        <textarea name="description" placeholder="Description" class="w-full border p-2 rounded"></textarea>

        <select name="priority" class="w-full border p-2 rounded">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
        <select name="category_id" class="w-full border p-2 rounded">
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded">
            Submit
        </button>
    </form>

@endsection

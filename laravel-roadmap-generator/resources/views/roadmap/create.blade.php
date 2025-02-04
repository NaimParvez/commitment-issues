@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Generate a New Roadmap</h2>
    <form action="{{ route('roadmap.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="course_name" class="block text-gray-700">Course Name</label>
            <input type="text" id="course_name" name="course_name" required class="w-full p-2 border rounded">
        </div>
        <div>
            <label for="duration" class="block text-gray-700">Duration (in weeks)</label>
            <input type="number" id="duration" name="duration" required class="w-full p-2 border rounded">
        </div>
        <div>
            <label for="level" class="block text-gray-700">Course Level</label>
            <select id="level" name="level" class="w-full p-2 border rounded" required>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
        </div>
        <div>
            <label for="purpose" class="block text-gray-700">Purpose of Learning</label>
            <textarea id="purpose" name="purpose" required class="w-full p-2 border rounded"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Generate Roadmap</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">{{ $roadmap->course_name }} Roadmap</h2>
    <p><strong>Duration:</strong> {{ $roadmap->duration }} weeks</p>
    <p><strong>Level:</strong> {{ ucfirst($roadmap->level) }}</p>
    <p><strong>Purpose:</strong> {{ $roadmap->purpose }}</p>
    <div class="mt-4 p-4 bg-gray-100 border rounded">
        {!! nl2br(e($roadmap->response)) !!}
    </div>
    <a href="{{ route('roadmap.index') }}" class="mt-4 inline-block text-blue-500 underline">← Back to My Roadmaps</a>
</div>
@endsection

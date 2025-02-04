@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">My Roadmaps</h2>
    @if($roadmaps->isEmpty())
        <p class="text-gray-500">You haven't created any roadmaps yet.</p>
    @else
        <ul class="space-y-4">
            @foreach($roadmaps as $roadmap)
                <li class="p-4 bg-gray-100 border rounded">
                    <h3 class="font-semibold text-lg">{{ $roadmap->course_name }}</h3>
                    <p><strong>Duration:</strong> {{ $roadmap->duration }} weeks</p>
                    <p><strong>Level:</strong> {{ ucfirst($roadmap->level) }}</p>
                    <p><strong>Purpose:</strong> {{ $roadmap->purpose }}</p>
                    <a href="{{ route('roadmap.show', $roadmap->id) }}" class="text-blue-500 underline">View Details</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

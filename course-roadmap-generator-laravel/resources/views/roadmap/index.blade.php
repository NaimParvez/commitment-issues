@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center" style="background-image: url('https://source.unsplash.com/1600x900/?education,learning');">
  <div class="bg-gray-900 bg-opacity-60 min-h-screen">
    <div class="container mx-auto px-4 py-12">
      <h2 class="text-4xl font-bold text-center text-white mb-10">My Roadmaps</h2>
      
      @if($roadmaps->isEmpty())
        <div class="bg-white bg-opacity-90 p-8 rounded-lg shadow-md text-center max-w-md mx-auto">
          <p class="text-gray-600 text-lg">You haven't created any roadmaps yet.</p>
          <a href="{{ route('roadmap.create') }}" class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-md shadow transition duration-300">
            Create Your First Roadmap
          </a>
        </div>
      @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach($roadmaps as $roadmap)
            <div class="bg-white rounded-lg shadow-xl p-6 hover:shadow-2xl transition duration-300">
              <!-- Use Str::title to capitalize each word -->
              <h3 class="font-bold text-2xl text-gray-800 mb-3 capitalize">
                {{ \Illuminate\Support\Str::title($roadmap->course_name) }}
              </h3>
              <p class="text-gray-600 mb-1">
                <strong>Duration:</strong> {{ $roadmap->duration }} weeks
              </p>
              <p class="text-gray-600 mb-1">
                <strong>Level:</strong> {{ ucfirst($roadmap->level) }}
              </p>
              <p class="text-gray-600 mb-4">
                <strong>Purpose:</strong> {{ ucfirst($roadmap->purpose) }}
              </p>
              <div class="flex items-center justify-between">
                <a href="{{ route('roadmap.show', $roadmap->id) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-300">
                  View Details
                </a>
                <!-- Delete Form -->
                <form action="{{ route('roadmap.destroy', $roadmap->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this roadmap?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-300">
                    Delete
                  </button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</div>
@endsection

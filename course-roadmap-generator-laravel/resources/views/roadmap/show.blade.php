@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">{{ $roadmap->course_name }} Roadmap</h2>
    <p class="mb-2"><strong>Duration:</strong> {{ $roadmap->duration }} weeks</p>
    <p class="mb-2"><strong>Level:</strong> {{ ucfirst($roadmap->level) }}</p>
    <p class="mb-4"><strong>Purpose:</strong> {{ $roadmap->purpose }}</p>
    
    <h3 class="text-xl font-semibold mb-2">Roadmap Checklist</h3>
    <p class="mb-4 text-gray-600">Mark each step as you complete it.</p>
    
    @php
        /*
         * Assuming your generated roadmap response is formatted with sections like:
         *
         * **Week 1**
         * * Objective: ...
         * * Topics: ...
         *
         * **Week 2**
         * * Objective: ...
         * * Topics: ...
         *
         * We use a regular expression to split the roadmap into steps.
         * This regex looks for headings that start with "**Week" and captures everything until the next heading or end-of-text.
         */
        preg_match_all('/\*\*Week\s*\d+\*\*(.*?)(?=\*\*Week|\z)/s', $roadmap->response, $matches);
        // Prepend the week header to each step (if needed). You can adjust as required.
        $steps = [];
        if (!empty($matches[0])) {
            foreach ($matches[0] as $i => $block) {
                // Append the matching header (the full block starting at "**Week") since our regex returns it in $matches[0].
                $steps[] = $block;
            }
        }
    @endphp

    @if(!empty($steps))
        <ul class="list-disc pl-6">
            @foreach($steps as $index => $step)
            <li class="mb-4">
                <label class="flex items-start">
                    <input type="checkbox" class="step-checkbox mr-2" data-index="{{ $index }}">
                    <div class="step-text">
                        {!! nl2br(e($step)) !!}
                    </div>
                </label>
            </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">No checklist items found in the generated roadmap.</p>
    @endif

    <div id="progress" class="mt-6">
        <strong>Progress: </strong><span id="progress-percentage">0%</span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.step-checkbox');
    const progressEl = document.getElementById('progress-percentage');

    function updateProgress() {
        let total = checkboxes.length;
        let checked = 0;
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checked++;
            }
        });
        let percent = total > 0 ? Math.round((checked / total) * 100) : 0;
        progressEl.textContent = percent + '%';
    }

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', updateProgress);
    });
});
</script>
@endsection

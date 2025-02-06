<?php

namespace App\Http\Controllers;

use App\Models\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class RoadmapController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roadmaps = Roadmap::where('user_id', Auth::id())->get();
        return view('roadmap.index', compact('roadmaps'));
    }

    public function create()
    {
        return view('roadmap.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'duration'    => 'required|integer|min:1',
            'level'       => 'required|in:beginner,intermediate,advanced',
            'purpose'     => 'required|string',
        ]);

        $aiResponse = $this->getCourseRoadmap($request->all());

        Roadmap::create([
            'user_id'     => Auth::id(),
            'course_name' => $request->course_name,
            'duration'    => $request->duration,
            'level'       => $request->level,
            'purpose'     => $request->purpose,
            'response'    => $aiResponse,
        ]);

        return redirect()->route('roadmap.index')->with('success', 'Roadmap generated successfully!');
    }

    public function destroy(Roadmap $roadmap)
{
    // Ensure that only the owner can delete the roadmap.
    if (Auth::id() !== $roadmap->user_id) {
        abort(403, 'Unauthorized action.');
    }

    $roadmap->delete();

    return redirect()->route('roadmap.index')->with('success', 'Roadmap deleted successfully.');
}


    private function getCourseRoadmap($data)
    {
        $apiKey = env('GEMINI_API_KEY');
        $prompt = "Generate a detailed, step-by-step course roadmap in markdown format for learning {$data['course_name']} as a {$data['level']} learner over {$data['duration']} weeks. For each week, please provide the following information using the format below, without any asterisks:

            Week 1:
               - Objective: [Describe the learning objective for week 1]
               - Topics: [List the key topics for week 1]
            
            Week 2:
               - Objective: [Describe the learning objective for week 2]
               - Topics: [List the key topics for week 2]
            
            Continue in this format for each week. Ensure the response is clear, well-structured, and visually appealing. most importently it should match the level of the learner and in the exact week.";
            

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . $apiKey;

        $payload = [
            "contents" => [
                [
                    "parts" => [
                        [ "text" => $prompt ]
                    ]
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($url, $payload);


        $json = $response->json();


        if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
            return $json['candidates'][0]['content']['parts'][0]['text'];
        }

        return 'No response received.';
    }

    public function show(Roadmap $roadmap)
    {
        return view('roadmap.show', compact('roadmap'));
    }
}

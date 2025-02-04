<?php

namespace App\Http\Controllers;

use App\Models\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class RoadmapController extends Controller
{
    /**
     * Create a new controller instance.
     * This ensures that all methods in this controller require an authenticated user.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // List all roadmaps for the authenticated user
    public function index()
    {
        $roadmaps = Roadmap::where('user_id', Auth::id())->get();
        return view('roadmap.index', compact('roadmaps'));
    }

    // Show the form to create a new roadmap
    public function create()
    {
        return view('roadmap.create');
    }

    // Process the form submission, call the Gemini API, and store the roadmap
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

    // Call the Gemini API (Google's Generative Language API) and return the AI-generated content
    private function getCourseRoadmap($data)
    {
        $apiKey = env('GEMINI_API_KEY');
        $prompt = "Create a {$data['level']} roadmap for learning {$data['course_name']} in {$data['duration']} weeks. Purpose: {$data['purpose']}";

        // Build the endpoint URL with your API key as a query parameter.
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . $apiKey;

        // Construct the JSON payload in the expected format.
        $payload = [
            "contents" => [
                [
                    "parts" => [
                        [ "text" => $prompt ]
                    ]
                ]
            ]
        ];

        // Make the HTTP POST request with appropriate headers.
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($url, $payload);

        // Decode the JSON response.
        $json = $response->json();

        // Check for the generated text in the JSON response.
        if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
            return $json['candidates'][0]['content']['parts'][0]['text'];
        }

        return 'No response received.';
    }

    // Show a single roadmap
    public function show(Roadmap $roadmap)
    {
        return view('roadmap.show', compact('roadmap'));
    }
}

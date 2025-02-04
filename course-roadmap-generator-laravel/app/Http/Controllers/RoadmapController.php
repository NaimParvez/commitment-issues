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


    private function getCourseRoadmap($data)
    {
        $apiKey = env('GEMINI_API_KEY');
        $prompt = "Create a {$data['level']} roadmap for learning {$data['course_name']} in {$data['duration']} weeks. Purpose: {$data['purpose']}";

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

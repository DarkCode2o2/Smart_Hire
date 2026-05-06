<?php

namespace App\Http\Controllers;

use App\Models\ResumeFile;
use App\Models\ResumeSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    static function analyzeResume(ResumeFile $resume) {

        $prompt = 'Act as a Senior Technical Recruiter. Analyze the provided Resume text with a critical eye. Extract the following fields: full_name, email, job_title, technical_skills (array), years_of_experience, and a summary. 
        Additionally, provide a point (0-100) based on:
        Depth and variety of technical skills.
        Quality and relevance of professional experience.
        Career progression and clarity of the summary.

        Return ONLY a valid JSON object in this format:
        {
        "full_name": "",
        "email": "",
        "job_title": "",
        "technical_skills": [],
        "years_of_experience": 0,
        "summary": "",
        "point": 0
        }';

        $text = $prompt . $resume->raw_text;
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent?key=" . env('API_GEMINI_KEY'), [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $text]
                    ]
                ]
            ]
        ]);

        $aiResponse = $response->json()['candidates'][0]['content']['parts'][0]['text'];

        preg_match('/\{.*\}/s', $aiResponse, $matches);
        $cleanJson = $matches[0] ?? null;

        if ($cleanJson) {
            $data = json_decode($cleanJson, true);
            
            $itemLowerSkills = array_map('strtolower', $data['technical_skills']);

            ResumeSummary::create([
                'resume_file_id' => $resume->id,
                'full_name'  => $data['full_name'] ?? 'Unknown',
                'email'      => $data['email'] ?? null,
                'job_title'  => $data['job_title'] ?? 'Unknown',
                'skills'     => json_encode($itemLowerSkills ?? []),
                'experience' => $data['years_of_experience'] ?? 0,
                'ai_summary' => $data['summary'] ?? '', 
                'point'      => $data['point'] ?? 0
            ]);


            return back()->with(['success' => 'Summary added succesfully!']);
            
        } else {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }
}

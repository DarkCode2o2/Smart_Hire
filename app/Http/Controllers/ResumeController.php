<?php

namespace App\Http\Controllers;

use App\Models\ResumeFile;
use App\Models\ResumeSummary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf as PdfToText;
use Barryvdh\DomPDF\Facade\Pdf;


class ResumeController extends Controller
{

    public function index() {
        return view('resumes.index');
    }
    
    public function upload() {
        return view('resumes.upload');
    }

    public function show(int $id) {
        $resume = ResumeSummary::findOrFail($id);
        return view('resumes.show', compact('resume'));
    }

    public function handleResume(Request $request) {
        $resumes = $request->file('resumes');

        $request->validate([
            'resumes' => 'required|array|max:5|min:1',
            'resumes.*' => 'required|file|mimes:pdf|max:3000'
        ], [
            'resumes.max'   => 'cannot upload more than 5 resumes',
            'resumes.*.mimes' => 'Only PDF are allowed',
            'resumes.*.max' => "a File can't be more than 3MB",
        ]);

        $binPath = 'C:/poppler/library/bin/pdftotext.exe';

        foreach($resumes as $resume) {
            $path = $resume->store('resumes', 'public');

            $resumeName = $resume->getClientOriginalName();

            $text = (new PdfToText($binPath))->setPdf(storage_path('app/public/' . $path))->text();
            
            $resumeFile = ResumeFile::create([
                'user_id' => Auth::id(),
                'resume_name' => $resumeName, 
                'path' => $path,
                'raw_text' => $text
            ]);

            ApiController::analyzeResume($resumeFile);
            sleep(2);
        }

        return back()->with(['success' => 'Resume has uploaded successfully!']);
    } 

    public function printPDF($id) {
        $resume = ResumeSummary::findOrFail($id); 

        $pdf = Pdf::loadView('resumes.printPDF', ['resume' => $resume]); 

        return $pdf->download($resume->full_name . '_Analysis.pdf');

    }
}

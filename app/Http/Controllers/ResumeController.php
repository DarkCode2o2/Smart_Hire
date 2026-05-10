<?php

namespace App\Http\Controllers;

use App\Models\ResumeFile;
use App\Models\ResumeSummary;
use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf as PdfToText;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{

    public function index(Request $request) {
        
        $query = Auth::user()->resumeSummaries();


        if($request->filled('search')) {
            $search = $request->search;

            $query->where(function($q) use ($search) {
                $q->where("full_name", "like", "%{$search}%")
                ->orwhereJsonContains("skills", $search);
            });
        }
        
        if($request->filled('min_score')) {
            $min_score = $request->min_score;
            $query->where("point", ">=", $min_score);
        }

        $summaries = $query->orderby('point', 'desc')->paginate(7)->appends($request->query());
        
        return view('resumes.index', compact('summaries'));
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
            'resumes.*' => 'required|file|mimes:pdf|max:2000'
        ],  [
            'resumes.max' => 'You can only upload up to 5 files.',
            'resumes.*.mimes' => 'All files must be PDFs.',
            'resumes.*.max' => 'Some files are too large (Max 2MB).',
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

        return $pdf->download(str_replace(' ', '_', $resume->full_name) . '_Analysis.pdf');

    }

    public function destroyResume($fileid) {

        $file = ResumeFile::findOrFail($fileid); 

        if(Auth::id() == $file->user_id) {
            if(Storage::path($file->path)) {
                Storage::delete($file->path);
            }

            $file->delete();

            return back()->with('success', 'Resume deleted successfully!');

        }
    }
}

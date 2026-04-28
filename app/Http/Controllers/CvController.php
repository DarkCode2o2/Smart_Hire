<?php

namespace App\Http\Controllers;

use App\Models\CvFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;

class CvController extends Controller
{
    
    public function uploadCv() {
        return view('uploadCv');
    }

    public function handleCv(Request $request) {
        $cvs = $request->file('cvs');

        $request->validate([
            'cvs' => 'required|array|max:5|min:1',
            'cvs.*' => 'required|file|mimes:pdf|max:3000'
        ], [
            'cvs.max'   => 'cannot upload more than 5 CVs',
            'cvs.*.mimes' => 'Only PDF are allowed',
            'cvs.*.max' => "a File can't be more than 3MB",
        ]);

        $binPath = 'C:/poppler/library/bin/pdftotext.exe';

        foreach($cvs as $cv) {
            $path = $cv->store('cvs', 'public');

            $cvName = $cv->getClientOriginalName();

            $text = (new Pdf($binPath))->setPdf(storage_path('app/public/' . $path))->text();
            
            CvFile::create([
                'user_id' => Auth::id(),
                'cv_name' => $cvName, 
                'path' => $path,
                'raw_text' => $text
            ]);

        }
        return back()->with(['success' => 'Cv has uploaded successfully!']);
    } 
}

<?php

namespace App\Http\Controllers;

use App\Models\ResumeFile;
use App\Models\ResumeSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index() {
        
        $summaries = Auth::user()->resumeSummaries()
                                    ->orderby('point', 'desc')->take(5)->get();
        return view('dashboard', ['summaries' => $summaries]);
    }

    public function updateResumeStatus(Request $request, $id) {
        $resume = ResumeSummary::findOrFail($id); 
        $resume->update(['status' => $request->status]);

        return back()->with('success', 'Status updated to ' . $request->status);
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

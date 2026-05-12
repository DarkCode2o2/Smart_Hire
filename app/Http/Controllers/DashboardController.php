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
        
        $allSummaries = Auth::user()->resumeSummaries; 

        $totalCount    = $allSummaries->count();
        $totalPending  = $allSummaries->where('status', 'pending')->count();
        $totalRejected = $allSummaries->where('status', 'rejected')->count();

        $topSummaries  = Auth::user()->resumeSummaries()
                            ->orderBy('point', 'desc')
                            ->take(5)
                            ->get();

        return view('dashboard', compact('topSummaries', 'totalCount', 'totalPending', 'totalRejected'));
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

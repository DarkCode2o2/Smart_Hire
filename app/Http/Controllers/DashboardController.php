<?php

namespace App\Http\Controllers;

use App\Models\ResumeSummary;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $query = ResumeSummary::query();

        
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

        $resumes = $query->orderby('point', 'desc')->get();

        return view('dashboard', ['resumes' => $resumes]);
    }

    public function updateResumeStatus(Request $request, $id) {
        $resume = ResumeSummary::findOrFail($id); 
        $resume->update(['status' => $request->status]);
        return back()->with('success', 'Status updated to ' . $request->status);
    }
}

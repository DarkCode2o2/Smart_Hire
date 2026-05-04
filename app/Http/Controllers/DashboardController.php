<?php

namespace App\Http\Controllers;

use App\Models\ResumeSummary;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $resumes = [];
        $resumes = ResumeSummary::orderby('point', 'desc')->take(5)->get();
        
        return view('dashboard', ['resumes' => $resumes]);
    }
}

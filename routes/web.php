<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::get('/api', [ApiController::class, 'index'])->middleware(['auth', 'verified'])->name('api_cv');


Route::middleware('auth')->group(function () {
    // Auth
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    // Dashboard
    Route::controller(DashboardController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::post('/dashboard/{id}/status', 'updateResumeStatus')->name('resume.updateStatus');
        Route::delete('/dashboard/{id}', 'destroyResume')->name('dashboard_resume.destroy');
    });

    // Upload Resume
    Route::controller(ResumeController::class)->group(function() {
        Route::get('/resumes',  'index')->name('resume.index');
        Route::get('/resume/upload',  'upload')->name('resume.upload');
        Route::post('/resume/upload',  'handleResume');
        Route::get('resume/{id}', 'show')->name('resume.show');
        Route::get('/resume/{id}/print', 'printPDF')->name('resume.print');
        Route::delete('/resume/{id}', 'destroyResume')->name('resume.destroy');

    });


});

require __DIR__.'/auth.php';

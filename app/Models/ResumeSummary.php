<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeSummary extends Model
{

    protected $fillable = [
        'resume_file_id',
        'full_name',
        'email', 
        'job_title',
        'skills', 
        'experience', 
        'ai_summary',
        'point'
    ];

    public function file() {
        return $this->belongsTo(ResumeFile::class, 'resume_file_id');
    }
}

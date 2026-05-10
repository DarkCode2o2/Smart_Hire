<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeFile extends Model
{

    protected $fillable = ['user_id', 'resume_name', 'path', 'raw_text'];

    public function summary() {
        return $this->hasOne(ResumeSummary::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}

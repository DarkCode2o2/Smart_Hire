<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvSummary extends Model
{
    public function file() {
        return $this->belongsTo(CvFile::class, 'cv_file_id');
    }
}

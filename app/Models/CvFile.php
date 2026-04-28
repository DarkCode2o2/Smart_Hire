<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvFile extends Model
{

    protected $fillable = ['user_id', 'cv_name', 'path', 'raw_text'];
    public function summary() {
        return $this->hasOne(CvSummary::class);
    }
}

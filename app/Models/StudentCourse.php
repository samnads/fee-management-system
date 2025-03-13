<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentCourse extends Model
{
    use SoftDeletes;
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

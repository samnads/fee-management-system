<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

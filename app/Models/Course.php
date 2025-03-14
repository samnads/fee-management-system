<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'duration', 'fee_per_month'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['total_fee'];
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_courses');
    }

    public function getTotalFeeAttribute()
    {
        return $this->duration * $this->fee_per_month;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'address', 'email', 'phone', 'dob'];
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses')->whereNull('student_courses.deleted_at');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

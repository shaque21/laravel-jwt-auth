<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CourseRegister extends Model
{
    use HasFactory;

    protected $fillable = ['course_id','student_id'];

    public function courses(){
        return $this->belongsTo('App\Models\Course','course_id','id');
    }

    public function student(){
        return $this->belongsTo('App\Models\User','student_id','id');
    }
}

<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';

    protected $primaryKey = 'id';

    protected $fillable = [
        'student_name',
        'student_age',
        'student_gender',
        'teacherId',
        'created_at',
        'updated_at'
    ];

     public function teacherselect()
    {
        return $this->belongsTo('App\model\Teacher', 'teacherId');
    }
}

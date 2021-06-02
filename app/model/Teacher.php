<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teacher';

    protected $primaryKey = 'id';

    protected $fillable = [
        'teacher_name',
        'created_at',
        'updated_at'
    ];
}

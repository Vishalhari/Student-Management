<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    protected $table = 'studentmark';

    protected $primaryKey = 'id';

    protected $fillable = [
        'studentId',
        'termId',
        'maths_mark',
        'science_mark',
        'history_mark',
        'created_at',
        'updated_at'
    ];


    public function studentselect()
    {
        return $this->belongsTo('App\model\Student', 'studentId');
    }

    public function termselect()
    {
        return $this->belongsTo('App\model\Terms', 'termId');
    }
}

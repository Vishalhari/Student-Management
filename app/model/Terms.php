<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    protected $table = 'term';

    protected $primaryKey = 'id';

    protected $fillable = [
        'term',
        'created_at',
        'updated_at'
    ];
}

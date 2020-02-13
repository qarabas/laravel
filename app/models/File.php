<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'title',
        'dir_id'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class cell extends Model
{
    protected $fillable = [
        'title',
        'arch_id'
    ];

}

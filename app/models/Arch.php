<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Arch extends Model
{
    protected $fillable = [
      'title'
    ];


    public static function getCells($arch_id, $orderBy = null, $limit = null)
    {
        return $arch_id ?  Cell::where('arch_id', '=', $arch_id)->orderBy($orderBy['field'], $orderBy['orderBy'])->simplePaginate($limit)->pluck('title', 'id') : false;
    }
}


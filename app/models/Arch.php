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

    public static function getArches()
    {
        return Arch::all();
    }
    public static function getArchIds()
    {
        $arches = Arch::getArches()->toArray();
        $ids = array();
        foreach ($arches as $arch){
            $ids[] = $arch['id'];
        }
        return $ids;
    }

}


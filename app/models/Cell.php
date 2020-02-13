<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    protected $fillable = [
        'title',
        'arch_id'
    ];

    public static function isExist($title)
    {
        return $title ? count(Cell::where('title', '=', $title)->pluck('title')) > 0 ? true : false : false;
    }

    public static function addCell($arch_id, $title)
    {
        $new_cell = new Cell();
        $new_cell->arch_id = $arch_id;
        $new_cell->title = $title;
        $new_cell->save();
        return $new_cell;
    }
    public static function getDirs($cell_id, $orderBy = null, $limit = null)
    {
        return $cell_id ?  Dir::where('cell_id', '=', $cell_id)->orderBy($orderBy['field'], $orderBy['orderBy'])->simplePaginate($limit)->pluck('title', 'id') : false;
    }
}

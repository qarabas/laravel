<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dir extends Model
{
    protected $fillable = [
        'title',
        'cell_id'
    ];

    public static function getFiles($dir_id, $orderBy = null, $limit = null)
    {
        return $dir_id ?  File::where('dir_id', '=', $dir_id)->orderBy($orderBy['field'], $orderBy['orderBy'])->simplePaginate($limit)->pluck('title', 'id') : false;
    }

    public static function getDirIds()
    {
        $dirs = Dir::getDirs()->toArray();
        $ids = array();
        foreach ($dirs as $dir){
            $ids[] = $dir['id'];
        }
        return $ids;
    }

    public static function getDirs()
    {
        return Dir::all();
    }

    public function getParent($parent_id){
        $title = DB::table('arches')->where('id', '=', $parent_id)->pluck('title', 'id');
        return $title;
    }

}
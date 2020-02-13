<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Search extends Model
{
    public static function getParent($cell_id){
        $title = DB::table('cells')
            ->select('cells.id', 'cells.arch_id', 'arches.title as arch_title', 'cells.title as cell_title')
            ->join('arches', 'arches.id', '=', 'arch_id')
            ->where('cells.id', '=', $cell_id)
            ->get();
        return $title;
    }

    public static function ArchCellLink($cell_id){
        $arches = search::getParent($cell_id);
        $arch_title = '';
        $cell_title = '';
        if ($arches){
            foreach ($arches as $k => $value){
                $arch_title = $value->arch_title;
                $cell_title = $value->cell_title;
            }
        }
        $new_link = $arch_title . '__' . $cell_title;
        return $new_link;
    }
}

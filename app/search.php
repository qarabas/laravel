<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class search extends Model
{
    public static function getParent($parent_id){
        $title = DB::table('arches')->where('id', '=', $parent_id)->pluck('title', 'id');
        return $title;
    }

    public static function ArchCellLink($cell_id){
        $arches = search::getParent($cell_id);
        if ($arches){
            foreach ($arches as $id => $title){
                $arch_title = $title;
            }
        }
        $cell_title = DB::table('cells')->where('id', '=', $cell_id)->pluck('title');
        foreach ($cell_title as $title){
            $c_title = $title;
        }

        $new_link = $arch_title . '__' . $c_title;
        return $new_link;
    }
}

<?php

namespace App\Http\Controllers;

use App\dir;
use App\search;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = DB::table('dirs')->where('title', 'LIKE', "%{$request->title}%")->get();
        foreach ($search as $item){
            $links = search::ArchCellLink($item->cell_id);
            $links = explode('__', $links);
            $item->arch_link = $links[0];
            $item->cell_link = $links[1];
        }
        return view('search', compact('search'));
    }
}

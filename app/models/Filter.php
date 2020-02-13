<?php


namespace App\models;


use Illuminate\Http\Request;

class Filter
{
    /**
     * @param Request $request
     * @return array
     */
//    Можно по идее класть выводимое количество страниц и номер страницы в редис или в сессию, и дергать уже оттуда, но это уже другая история
    public static function buildFilterArr(Request $request)
    {
        $page_url = str_replace('page=' . $request->page, 'page=', $request->fullUrl());
        $limit_url = str_replace('&limit=' . $request->limit, '', $request->fullUrl());
        $limit = 8;
        if ($request->limit){
            $limit = $request->limit;
        }
        if ($request->order){
            $order_by_field = [
                'field' => $request->order,
                'orderBy' => $request->by,
                'page' => $request->page,
                'url' => $limit_url,
                'limit' => $limit,
                'next_page' => $page_url . ($request->page + 1),
                'prev_page' => $page_url . ($request->page - 1),
            ];
        }else{
            $order_by_field = [
                'field' => 'id',
                'orderBy' => 'DESC',
                'page' => $request->page,
                'url' => $limit_url,
                'limit' => $limit,
                'next_page' => $page_url . ($request->page + 1),
                'prev_page' => $page_url . ($request->page - 1),
            ];
        }
        return $order_by_field;
    }
}

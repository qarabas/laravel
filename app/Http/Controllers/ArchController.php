<?php

namespace App\Http\Controllers;

use App\models\Arch;
use App\models\Cell;
use App\models\Filter;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ArchController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arches = Arch::orderBy('id', 'desc')
            ->get();
        return view('arch.index', compact('arches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('arch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'title' => 'required|unique:arches',
        ]);

        Arch::create($request->all());
        return redirect()->route('arch.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Arch  $arch
     * @return \Illuminate\Http\Response
     */
    public function show(Arch $arch, Request $request)
    {
        $order_by_field = Filter::buildFilterArr($request);
        $children = Arch::getCells($arch->id, $order_by_field, $order_by_field['limit']);
        return view('arch.show', compact('arch', 'children', 'order_by_field'));
    }

    public function addOrderBy($arch_id, $order_by)
    {
        $children = Arch::getCells($arch_id, 'DESC');
        return view('arch.show', compact('arch', 'children'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Arch  $arch
     * @return \Illuminate\Http\Response
     */
    public function edit(Arch $arch)
    {
        return view('arch.edit', compact('arch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Arch  $arch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arch $arch)
    {
        $request->validate([
           'title' => 'required|unique:arches'
        ]);

        $arch->update($request->all());
        return redirect()->route('arch.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Arch  $arch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arch $arch)
    {
        $arch->delete();
            return redirect()->route('arch.index');
    }

    public function createCell(Request $request)
    {
        if ($request->ajax() && $request->method() === 'GET'){
            $arch_id = $request->id;
            $title = $request->title;
            $is_exist = Cell::isExist($title);
            if ($is_exist){
                return ['error' => 'Ячейка с таким названием уже существует.'];
            }else{
                $new_cell = Cell::addCell($arch_id, $title);
                return ['error' => null];
            }
        }
    }

    public function setOrder(Request $request, $id)
    {
        echo '<pre>';
        var_dump($request->session()->get('key'));
        echo '</pre>';
        die();
    }
}

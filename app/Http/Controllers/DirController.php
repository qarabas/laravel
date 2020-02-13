<?php

namespace App\Http\Controllers;

use App\models\Cell;
use App\models\Dir;
use App\models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dirs = Dir::orderBy('id', 'desc')
            ->get();
        return view('dir.index', compact('dirs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cell_id = $request->cell_id ? $request->cell_id : null;
        $cells = Cell::all('title', 'id');
        return view('dir.create', compact( 'cell_id', 'cells'));
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
            'title' => 'required|unique:dirs',
            'cell_id' => 'required'
        ]);
        Dir::create($request->all());
        return redirect()->route('cell.show', ['cell'=> $request->cell_id, 'page' => 1])
            ->with('success', 'Ячейка создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dir  $dir
     * @return \Illuminate\Http\Response
     */
    public function show(Dir $dir, Request $request)
    {
        $order_by_field = Filter::buildFilterArr($request);
        $children = Dir::getFiles($dir->id, $order_by_field, $order_by_field['limit']);
        return view('dir.show', compact('dir', 'children', 'order_by_field'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\dir  $dir
     * @return \Illuminate\Http\Response
     */
    public function edit(Dir $dir)
    {
        $cells = DB::table('cells')->get();
        return view('dir.edit', compact('cells','dir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dir  $dir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dir $dir)
    {
        $request->validate([
            'title' => 'required',
            'cell_id' => 'required',
        ]);

        $dir->update($request->all());
        return redirect()->route('cell.show', ['cell' => $request->cell_id, 'page' => 1])
            ->with('success', 'архив обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dir  $dir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dir $dir)
    {
        $dir->delete();
        return redirect()->route('dir.index')
            ->with('success', 'архив удален');
    }
}

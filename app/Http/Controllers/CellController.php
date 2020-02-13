<?php

namespace App\Http\Controllers;

use App\models\Arch;
use App\models\Cell;
use App\models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cells = Cell::orderBy('id', 'desc')
            ->get();
        return view('cell.index', compact('cells'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arches = Arch::all('title', 'id');
        return view('cell.create', compact('arches'));
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
            'title' => 'required|unique:cells',
            'arch_id' => 'required'
        ]);

        Cell::create($request->all());
        return redirect()->route('cell.show', ['cell'=> $request])
            ->with('success', 'Ячейка создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function show(Cell $cell, Request $request)
    {
        $order_by_field = Filter::buildFilterArr($request);
        $children = Cell::getDirs($cell->id, $order_by_field, $order_by_field['limit']);
        return view('cell.show', compact('cell', 'children', 'order_by_field'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function edit(Cell $cell)
    {
        $cells = DB::table('arches')->pluck('title', 'id');
        return view('cell.edit', compact('cells','cell'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cell $cell)
    {
        $request->validate([
            'title' => 'required',
            'arch_id' => 'required',
        ]);
        $cell->update($request->all());
        return redirect()->route('cell.index')
            ->with('success', 'архив обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cell $cell)
    {
        $cell->delete();
        return redirect('arch/'. $cell->arch_id);
    }

}

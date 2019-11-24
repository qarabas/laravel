<?php

namespace App\Http\Controllers;

use App\arch;
use App\cell;
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
        $cells = cell::orderBy('id', 'desc')
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
        $arches = arch::all('title', 'id');
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
            'title' => 'required',
            'arch_id' => 'required'
        ]);

        cell::create($request->all());
        return redirect()->route('cell.index')
            ->with('success', 'Ячейка создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function show(cell $cell)
    {
        $children = DB::table('dirs')->where('cell_id', '=', $cell->id)->pluck('title', 'id');
        return view('cell.show', compact('cell', 'children'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function edit(cell $cell)
    {
        $cells = DB::table('arches')->pluck('title', 'id');
        return view('cell.edit', compact('cells','cell'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cell $cell)
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
     * @param  \App\cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function destroy(cell $cell)
    {
        $cell->delete();
        return redirect()->route('cell.index')
            ->with('success', 'архив удален');
    }

    public function search(Request $request){
        dd($request);
    }
}

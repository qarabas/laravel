<?php

namespace App\Http\Controllers;

use App\cell;
use App\dir;
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
        $dirs = dir::orderBy('id', 'desc')
            ->get();
        return view('dir.index', compact('dirs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cells = cell::all('title', 'id');
        return view('dir.create', compact('cells'));
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
            'cell_id' => 'required'
        ]);

        dir::create($request->all());
        return redirect()->route('dir.index')
            ->with('success', 'Ячейка создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\dir  $dir
     * @return \Illuminate\Http\Response
     */
    public function show(dir $dir)
    {
        $children = DB::table('files')->where('dir_id', '=', $dir->id)->pluck('title', 'id');
        return view('dir.show', compact('dir', 'children'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\dir  $dir
     * @return \Illuminate\Http\Response
     */
    public function edit(dir $dir)
    {
        $cells = DB::table('cells')->get();
        return view('dir.edit', compact('cells','dir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\dir  $dir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dir $dir)
    {
        $request->validate([
            'title' => 'required',
            'cell_id' => 'required',
        ]);

        $dir->update($request->all());
        return redirect()->route('dir.index')
            ->with('success', 'архив обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\dir  $dir
     * @return \Illuminate\Http\Response
     */
    public function destroy(dir $dir)
    {
        $dir->delete();
        return redirect()->route('dir.index')
            ->with('success', 'архив удален');
    }
}

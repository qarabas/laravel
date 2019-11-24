<?php

namespace App\Http\Controllers;

use App\dir;
use App\file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = file::orderBy('id', 'desc')
            ->get();
        return view('file.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dirs = dir::all('title', 'id');
        return view('file.create', compact('dirs'));
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
            'dir_id' => 'required'
        ]);

        file::create($request->all());
        return redirect()->route('file.index')
            ->with('success', 'Ячейка создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\file  $file
     * @return \Illuminate\Http\Response
     */
    public function show(file $file)
    {
        return view('file.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\file  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(file $file)
    {
        $dirs = DB::table('cells')->pluck('title', 'id');
        return view('file.edit', compact('dirs','file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\file  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, file $file)
    {
        $request->validate([
            'title' => 'required',
            'dir_id' => 'required',
        ]);
        $file->update($request->all());
        return redirect()->route('file.index')
            ->with('success', 'файл обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\file  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(file $file)
    {
        $file->delete();
        return redirect()->route('file.index')
            ->with('success', 'файл удален');
    }
}

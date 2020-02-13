<?php

namespace App\Http\Controllers;

use App\models\Dir;
use App\models\File;
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
        $files = File::orderBy('id', 'desc')
            ->get();
        return view('file.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dir_id = $request->dir_id ? $request->dir_id : null;
        $dirs = Dir::all('title', 'id');
        return view('file.create', compact('dir_id', 'dirs'));
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
            'title' => 'required|unique:files',
            'dir_id' => 'required'
        ]);

        File::create($request->all());
        return redirect()->route('dir.show', ['dir'=> $request->dir_id, 'page' => 1])
            ->with('success', 'Ячейка создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file, Request $request)
    {
        return view('file.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        $dirs = DB::table('cells')->pluck('title', 'id');
        return view('file.edit', compact('dirs','file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
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
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file->delete();
        return redirect()->route('file.index')
            ->with('success', 'файл удален');
    }
}

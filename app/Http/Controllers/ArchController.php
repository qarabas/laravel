<?php

namespace App\Http\Controllers;

use App\arch;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;

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
        $arches = arch::orderBy('id', 'desc')
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
           'title' => 'required'
        ]);

        arch::create($request->all());
        return redirect()->route('arch.index')
            ->with('success', 'Архив создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\arch  $arch
     * @return \Illuminate\Http\Response
     */
    public function show(arch $arch)
    {
        $children = DB::table('cells')->where('arch_id', '=', $arch->id)->pluck('title', 'id');
        return view('arch.show', compact('arch', 'children'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\arch  $arch
     * @return \Illuminate\Http\Response
     */
    public function edit(arch $arch)
    {
        return view('arch.edit', compact('arch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\arch  $arch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, arch $arch)
    {
        $request->validate([
           'title' => 'required'
        ]);

        $arch->update($request->all());
        return redirect()->route('arch.index')
            ->with('success', 'архив обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\arch  $arch
     * @return \Illuminate\Http\Response
     */
    public function destroy(arch $arch)
    {
        $arch->delete();
            return redirect()->route('arch.index')
                ->with('success', 'архив удален');
    }
}

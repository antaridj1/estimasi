<?php

namespace App\Http\Controllers;

use App\Models\Indek;
use Illuminate\Http\Request;

class IndekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Indek $indek)
    {
        $indek = Indek::all();
        return view('admin.indeks',compact('indek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori'=>'required',
            'tingkatan'=>'required',
            'bobot_indeks'=>'required',
            'keterangan'=>'required',
        ]);

        Indek::create($request->all());
            // 'kategori'=>$request->kategori,
            // 'tingkatan'=>$request->tingkatan,
            // 'bobot_indeks'=>$request->bobot_indeks,
            // 'keterangan'=>$request->keterangan,
        
        return redirect('dashboard/indeks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Indek  $indek
     * @return \Illuminate\Http\Response
     */
    public function show(Indek $indek)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Indek  $indek
     * @return \Illuminate\Http\Response
     */
    public function edit(Indek $indek)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Indek  $indek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indek $indek)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Indek  $indek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indek $indek)
    {
        //
    }
}

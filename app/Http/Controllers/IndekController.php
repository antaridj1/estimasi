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
    public function index(Indek $indeks)
    {
        $indeks = Indek::all();
        return view('admin.indeks',compact('indeks'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori'=>'required',
            'tingkatan'=>'required',
            'bobot_indeks'=>'required',
            'keterangan'=>'required',
        ]);

        Indek::create($request->all());

        return redirect('dashboard/indeks');
    }

   
    public function update(Request $request, Indek $indeks)
    {
        Indek::where('id',$request->id)->update([
            'nama' => $request->nama,
            'kategori'=>$request->kategori,
            'tingkatan'=>$request->tingkatan,
            'bobot_indeks'=>$request->bobot_indeks,
            'keterangan' =>$request->keterangan,
        ]);
        return redirect('/dashboard/indeks');
    }

    public function updateStatus(Indeks $indeks)
    {
        $id = $indeks->id;

        if( $indeks->status == false){
            Indeks::where('id',$id)->update([
                'status'=>true,
            ]);
            return redirect('/dashboard/indeks')->with('status','data diaktifkan');
        }
        else {
            Indeks::where('id',$id)->update([
                'status'=>false,
            ]);
            return redirect('/dashboard/indeks')->with('status','data dinonaktifkan');
        }
    }
}

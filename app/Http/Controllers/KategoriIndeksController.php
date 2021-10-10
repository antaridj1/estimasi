<?php

namespace App\Http\Controllers;

use App\Models\KategoriIndeks;
use Illuminate\Http\Request;

class KategoriIndeksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KategoriIndeks $kategoriIndeks)
    {
        $kategoriIndeks = KategoriIndeks::all();
        return view('admin.kategoriIndeks',compact('kategoriIndeks'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'bobot_kategori'=>'required',
            'keterangan'=>'required',
        ]);

        KategoriIndeks::create($request->all());

        return redirect('dashboard/kategoriIndeks');
    }

   
    public function update(Request $request, KategoriIndeks $kategoriIndeks)
    {
        KategoriIndeks::where('id',$request->id)->update([
            'nama' => $request->nama,
            'bobot_kategori'=>$request->bobot_kategori,
            'keterangan' =>$request->keterangan,
        ]);
        return redirect('/dashboard/kategoriIndeks');
    }

    public function updateStatus(KategoriIndeks $kategoriIndeks)
    {
        $id = $kategoriIndeks->id;

        if( $kategoriIndeks->status == false){
            KategoriIndeks::where('id',$id)->update([
                'status'=>true,
            ]);
            return redirect('/dashboard/kategoriIndeks')->with('status','data diaktifkan');
        }
        else {
            KategoriIndeks::where('id',$id)->update([
                'status'=>false,
            ]);
            return redirect('/dashboard/kategoriIndeks')->with('status','data dinonaktifkan');
        }
    }
}

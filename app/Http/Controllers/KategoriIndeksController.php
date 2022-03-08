<?php

namespace App\Http\Controllers;

use App\Models\KategoriIndeks;
use Illuminate\Support\Str;
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
        $kategoriIndeks = KategoriIndeks::cari(request(['search']))->paginate(10)->withQueryString();
        return view('admin.kategoriIndeks',compact('kategoriIndeks'));
    }

  
    public function store(Request $request)
    {   try{
            $request->validate([
                'nama' => 'required',
                'bobot_kategori'=>'required|numeric|min:0|max:1',
                'keterangan'=>'required',
            ]);

            KategoriIndeks::create([
                'nama' => $request->nama,
                'bobot_kategori'=>$request->bobot_kategori,
                'keterangan' =>$request->keterangan,
                'slug'=>Str::slug($request->nama,'_'),
            ]);
        } catch (Exception $e) {
            return back()->with('gagal','error');
        }
        return redirect('/dashboard/kategoriIndeks')->with('input_berhasil','success');
    }

    public function update(Request $request, KategoriIndeks $kategoriIndeks)
    {
        try{
            $request->validate([
                'nama' => 'required',
                'bobot_kategori'=>'required|numeric|min:0|max:1',
                'keterangan'=>'required',
            ]);

            KategoriIndeks::where('id',$request->id)->update([
                'nama' => $request->nama,
                'bobot_kategori'=>$request->bobot_kategori,
                'keterangan' =>$request->keterangan,
                'slug'=>Str::slug($request->nama,'_'),
            ]);
        } catch (Exception $e) {
            return back()->with('gagal','error');
        }
        return redirect('/dashboard/kategoriIndeks')->with('update_berhasil','success');
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

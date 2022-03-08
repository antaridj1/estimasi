<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gedung;
use Throwable;

class GedungController extends Controller
{
    public function index(Gedung $gedungs)
    {   
       $gedungs = Gedung::cari(request(['search']))->paginate(10)->withQueryString();
        return view('admin.gedung',compact('gedungs'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'nama'=>'required|max:255',
            'bobot_indeks'=>'required|numeric|min:0|max:1',
            'biaya'=>'required|numeric|min:1',
            'keterangan'=>'required',
        ]);
       try{
        Gedung::create($request->all()); 

        } catch (Exception $e) {
        return back()->with('gagal','error');
        }

        return redirect('/dashboard/gedung')->with('input_berhasil','success');
    }

    public function update(Request $request, Gedung $gedungs)
    {
        try {
            $request->validate([
            'nama'=>'required|max:255',
            'bobot_indeks'=>'required|numeric|min:0|max:1',
            'biaya'=>'required|numeric|min:1',
            'keterangan'=>'required',
            ]);

            Gedung::where('id',$request->id)->update([
            'nama'=>$request->nama,
            'bobot_indeks'=>$request->bobot_indeks,
            'biaya'=>$request->biaya,
            'keterangan' =>$request->keterangan,
            ]);

          } catch (Exception $e) {
                return back()->with('message','Gagal update data')->with('gagal','error');
          }

        return redirect('/dashboard/gedung')->with('update_berhasil','success');
    }

    public function updateStatus(Gedung $gedung)
    {
        $id = $gedung->id;

        if( $gedung->status == false){
            Gedung::where('id',$id)->update([
                'status'=>true,
            ]);
            return redirect('/dashboard/gedung')->with('status','data diaktifkan');
        }
        else {
            Gedung::where('id',$id)->update([
                'status'=>false,
            ]);
            return redirect('/dashboard/gedung')->with('status','data dinonaktifkan');
        }
    }
}

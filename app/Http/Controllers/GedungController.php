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

        } catch (Throwable $e){
            return back()->with('error','gagal');
        }
        return redirect('dashboard/gedung');
        
    }

    public function update(Request $request, Gedung $gedungs)
    {
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
        return redirect('/dashboard/gedung');
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

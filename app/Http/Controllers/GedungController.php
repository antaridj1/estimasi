<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gedung;

class GedungController extends Controller
{
    public function index(Gedung $gedungs)
    {
        $gedungs = Gedung::all();
        return view('admin.gedung',compact('gedungs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'bobot_indeks'=>'required',
            'biaya'=>'required',
            'keterangan'=>'required',
        ]);

        Gedung::create($request->all());  
        return redirect('dashboard/gedung');
    }

    public function update(Request $request, Gedung $gedungs)
    {
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

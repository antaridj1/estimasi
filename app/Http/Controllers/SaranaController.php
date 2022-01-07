<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sarana;
class SaranaController extends Controller
{
    public function index(Sarana $saranas)
    {
        $saranas = Sarana::all();
        return view('admin.sarana',compact('saranas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'kategori'=>'required',
            'biaya'=>'required|numeric',
            'keterangan'=>'required',
        ]);

        Sarana::create($request->all());  
        return redirect('dashboard/sarana');
    }

    public function update(Request $request, Sarana $saranas)
    {
        $request->validate([
            'nama'=>'required',
            'kategori'=>'required',
            'biaya'=>'required|numeric',
            'keterangan'=>'required',
        ]);
        
        Sarana::where('id',$request->id)->update([
            'nama'=>$request->nama,
            'kategori'=>$request->kategori,
            'biaya'=>$request->biaya,
            'keterangan' =>$request->keterangan,
        ]);
        return redirect('/dashboard/sarana');
    }

    public function updateStatus(Sarana $sarana)
    {
        $id = $sarana->id;

        if( $sarana->status == false){
            Sarana::where('id',$id)->update([
                'status'=>true,
            ]);
            return redirect('/dashboard/sarana')->with('status','data diaktifkan');
        }
        else {
            Sarana::where('id',$id)->update([
                'status'=>false,
            ]);
            return redirect('/dashboard/sarana')->with('status','data dinonaktifkan');
        }
    }
    
}

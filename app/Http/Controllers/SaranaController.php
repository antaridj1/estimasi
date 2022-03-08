<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sarana;
class SaranaController extends Controller
{
    public function index(Sarana $saranas)
    {
        $saranas= Sarana::orderBy('kategori')->orderBy('nama')->cari(request(['search']))->paginate(10)->withQueryString();
        return view('admin.sarana',compact('saranas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'kategori'=>'required',
            'biaya'=>'required|numeric|min:1',
            'keterangan'=>'required',
        ]);
        try{
            Sarana::create($request->all()); 
        } catch (Exception $e) {
            return back()->with('gagal','error');
        }
        return redirect('/dashboard/sarana')->with('input_berhasil','success');
    }

    public function update(Request $request, Sarana $saranas)
    {
        try{
            $request->validate([
                'nama'=>'required',
                'kategori'=>'required',
                'biaya'=>'required|numeric|min:1',
                'keterangan'=>'required',
            ]);
            
            Sarana::where('id',$request->id)->update([
                'nama'=>$request->nama,
                'kategori'=>$request->kategori,
                'biaya'=>$request->biaya,
                'keterangan' =>$request->keterangan,
            ]);
        } catch (Exception $e) {
            return back()->with('gagal','error');
        }
        return redirect('/dashboard/sarana')->with('update_berhasil','success');
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

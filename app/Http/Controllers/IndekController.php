<?php

namespace App\Http\Controllers;

use App\Models\Indek;
use App\Models\KategoriIndeks;
use Illuminate\Http\Request;

class IndekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indeks = Indek::filter(request(['search','parameter']))->paginate(10)->withQueryString();
       // dd(request('search'));
        $kategori = KategoriIndeks::all();
        return view('admin.indeks',compact(['indeks','kategori']));
    }

  
    public function store(Request $request)
    {
       
        
        if($request->parameter == "klasifikasi"){
            $request->validate([
                'kategori_indeks_id'=>'required',
                'tingkatan'=>'required',
                'bobot_indeks'=>'required|numeric',
                'parameter'=>'required',
                'keterangan'=>'required',
            ]);
            Indek::create($request->all());
        } else {
            $request->validate([
                'tingkatan'=>'required',
                'bobot_indeks'=>'required|numeric',
                'parameter'=>'required',
                'keterangan'=>'required',
            ]);
            Indek::create([
                'tingkatan'=>$request->tingkatan,
                'bobot_indeks'=>$request->bobot_indeks,
                'parameter'=>$request->parameter,
                'keterangan' =>$request->keterangan,
            ]);
        }
        

        return redirect('dashboard/indeks');
    }

   
    public function update(Request $request, Indek $indeks)
    {
        if($request->parameter == "klasifikasi"){
            $request->validate([
                'kategori_indeks_id'=>'required',
                'tingkatan'=>'required',
                'bobot_indeks'=>'required|numeric',
                'parameter'=>'required',
                'keterangan'=>'required',
            ]);
            Indek::where('id',$request->id)->update([
                'kategori_indeks_id'=>$request->kategori_indeks_id,
                'tingkatan'=>$request->tingkatan,
                'bobot_indeks'=>$request->bobot_indeks,
                'parameter'=>$request->parameter,
                'keterangan' =>$request->keterangan,
            ]);
        } else {
            $request->validate([
                'tingkatan'=>'required',
                'bobot_indeks'=>'required|numeric',
                'parameter'=>'required',
                'keterangan'=>'required',
            ]);
            Indek::where('id',$request->id)->update([
                'tingkatan'=>$request->tingkatan,
                'bobot_indeks'=>$request->bobot_indeks,
                'parameter'=>$request->parameter,
                'keterangan' =>$request->keterangan,
            ]);
        }

        return redirect('/dashboard/indeks');
    }

    public function updateStatus(Indek $indeks)
    {
        $id = $indeks->id;

        if( $indeks->status == false){
            Indek::where('id',$id)->update([
                'status'=>true,
            ]);
            return redirect('/dashboard/indeks')->with('status','data diaktifkan');
        }
        else {
            Indek::where('id',$id)->update([
                'status'=>false,
            ]);
            return redirect('/dashboard/indeks')->with('status','data dinonaktifkan');
        }
    }
}

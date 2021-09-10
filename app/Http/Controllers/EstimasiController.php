<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estimasi;
use App\Models\Gedung;
use App\Models\Indek;
use App\Models\Sarana;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class EstimasiController extends Controller
{
    public function index(Request $request, Sarana $shows){
        $gedungs = Gedung::get('nama');
        $fungsis = Indek::where('kategori','fungsi')->get('nama');
        $kompleksitas = Indek::where('nama','kompleksitas')->get('tingkatan');
        $kategori_sarana = Sarana::distinct('kategori')->get(['kategori','id']);
        $saranas = Sarana::get(['nama','kategori','id']);
        //dd($request->sarana);
       // $shows = Sarana::where('nama',$arr)->get();
        //dd($shows);
        return view('hitung',compact(
            'gedungs','fungsis','kompleksitas','kategori_sarana','saranas'
        ));
    }

    // public function showSarana(Request $request){
    //     $shows = Sarana::where('nama',$request->nama)->select('nama');
    //     return view('hitung',compact('shows'));
    // }
}
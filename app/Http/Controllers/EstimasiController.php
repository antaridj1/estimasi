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
    public function index(){
        $gedungs = Gedung::get(['nama','id']);
        $indeks = Indek::distinct('nama')->get(['nama','kategori']);
        $tingkatan_indeks = Indek::get(['tingkatan','nama','id']);
        $fungsis = Indek::where('kategori','fungsi')->get(['nama','id']);
        $jangka_waktu = Indek::where('kategori','waktu')->get(['nama','id']);

        $collection = Sarana::all();
        $unique = $collection->unique('kategori');
        $kategori_sarana = $unique->values()->all();

        $saranas = Sarana::get(['nama','kategori','id']);

        return view('hitung',compact(
            'gedungs','tingkatan_indeks','indeks','fungsis','jangka_waktu','kategori_sarana','saranas'
        ));
    }

    public function hitungEstimasi(Request $request){
        $a = Indek::where('id',$request->kompleksitas)->value('bobot_indeks');
        $b = Indek::where('id',$request->permanensi)->value('bobot_indeks');
        $c = Indek::where('id',$request->zonasi_kebakaran)->value('bobot_indeks');
        $d = Indek::where('id',$request->zona_gempa)->value('bobot_indeks');
        $e = Indek::where('id',$request->kepadatan_gedung)->value('bobot_indeks');
        $f = Indek::where('id',$request->ketinggian_bangunan)->value('bobot_indeks');
        $g = Indek::where('id',$request->kepemilikan)->value('bobot_indeks');

       // dd($i[3]);
       
      // for($a=0;$a<=6;$a++){
          // $ik = $ik + $i[$a];
         $ik = $a+$b+$c+$d+$e+$f+$g;
      
      // }

        $fungsi = Indek::where('id',$request->fungsi)->value('bobot_indeks');
        $waktu = Indek::where('id',$request->waktu)->value('bobot_indeks');

        $it = $ik*$fungsi*$waktu;
        
        $status = Gedung::where('id',$request->gedung)->value('bobot_indeks');
        $biaya = Gedung::where('id',$request->gedung)->value('biaya');
        $luas = $request->luas_bangunan;

        $bangunan_gedung = $luas*$it*$status*$biaya;

        $namasarana = collect($request->sarana);
        $length = count($namasarana);
        $jmlh = collect($request->jumlah_sarana);
        $costs = collect();
        
        for($a=0;$a<$length;$a++){
            $x = Sarana::where('nama',$namasarana[$a])->value('biaya');
            $cost = $x*$jmlh[$a];
            $costs->push($cost);
        }

        $total_sarana = $costs->sum();

        $total_estimasi = $bangunan_gedung + $total_sarana;
        dd($total_estimasi);
        
        
        
        return redirect('hitung');
    }

    
}
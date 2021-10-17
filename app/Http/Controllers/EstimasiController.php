<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estimasi;
use App\Models\Gedung;
use App\Models\Indek;
use App\Models\Sarana;
use App\Models\KategoriIndeks;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class EstimasiController extends Controller
{
    public function index(){
        $gedungs = Gedung::get(['nama','id']);
       // $indeks = Indek::distinct('nama')->get(['nama','kategori']);
        $kategori_indeks = KategoriIndeks::all();
        $indeks = Indek::where('parameter','klasifikasi')->get(['id','tingkatan','kategori_indeks_id']);
        $fungsis = Indek::where('parameter','fungsi')->get(['tingkatan','id']);
        $jangka_waktu = Indek::where('parameter','waktu')->get(['tingkatan','id']);

        $collection = Sarana::all();
        $unique = $collection->unique('kategori');
        $kategori_sarana = $unique->values()->all();

        $saranas = Sarana::get(['nama','kategori','id']);

        return view('hitung',compact(
            'kategori_indeks','gedungs','indeks','fungsis','jangka_waktu','kategori_sarana','saranas'
        ));
    }

    public function hitungEstimasi(Request $request){
        
        $ktgr = KategoriIndeks::pluck('nama');
        $ktgr_length = count($kategori);
        $arr = collect(); 

        for($i=0;$i<$ktgr_length;$i++){
  
            $arr = $ktgr[$i]; //kategori masih salah, harusnya ga pake spasi di request
            $bobot_indeks = Indek::where('id',$request->$arr)->value('bobot_indeks');
            $ktgr_id = Indek::where('id',$request->$arr)->value('kategori_indeks_id');
            $bobot_ktgr = KategoriIndeks::where('id',$ktgr_id)->value('bobot_kategori');
            $total_bobot = $bobot_indeks*$bobot_ktgr;
            $arr->push($total_bobot);
           
         }
         $ik = $arr->sum();
          dd($ik);
        
        // $a = Indek::where('id',$request->kompleksitas)->value('bobot_indeks');
        // $b = Indek::where('id',$request->permanensi)->value('bobot_indeks');
        // $c = Indek::where('id',$request->zonasi_kebakaran)->value('bobot_indeks');
        // $d = Indek::where('id',$request->zona_gempa)->value('bobot_indeks');
        // $e = Indek::where('id',$request->kepadatan_gedung)->value('bobot_indeks');
        // $f = Indek::where('id',$request->ketinggian_bangunan)->value('bobot_indeks');
        // $g = Indek::where('id',$request->kepemilikan)->value('bobot_indeks');
       
       
      
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
        
        // DetailEstimasi::create([
        //     'estimasi_id'=>$request->id;
        //     'indeks_id'=>$request->indeks[];
        // ]);

        // DetailSarana::create([
        //     'estimasi_id'=>$request->id;
        //     'sarana_id'=>$request->sarana[];
        //     'jumlah_sarana'=>$request_jumlah_sarana;
        // ]);
        
        // Estimasi::create([
        //     'luas_tanah'=>$request->luas_tanah;
        //     'luas_bangunan'=>$request->luas_bangunan;
        //     'masyarakats_id'=>$request->masyarakat;
        //     'gedungs_id'=>$request->gedung;
        //     'total_estimasi'=>$total_estimasi;
        // ]);
        
        return redirect('hitung');
    }

    
}
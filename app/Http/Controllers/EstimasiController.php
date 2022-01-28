<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estimasi;
use App\Models\Gedung;
use App\Models\Indek;
use App\Models\Sarana;
use App\Models\KategoriIndeks;
use App\Models\DetailSarana;
use App\Models\DetailEstimasi;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use DB;

class EstimasiController extends Controller
{
    public function landing(){
        return view('estimasi');
    }

    public function index(){
        $gedungs = Gedung::where('status','1')->get(['nama','id']);
        // $indeks = Indek::distinct('nama')->get(['nama','kategori']);
        $kategori_indeks = KategoriIndeks::where('status','1')->get();
        $indeks = Indek::where([['parameter','klasifikasi'],['status','1']])->orderBy('bobot_indeks')->get(['id','tingkatan','kategori_indeks_id']);
        $fungsis = Indek::where([['parameter','fungsi'],['status','1']])->get(['tingkatan','id']);
        $jangka_waktu = Indek::where([['parameter','waktu'],['status','1']])->orderBy('bobot_indeks')->get(['tingkatan','id']);
        $collection = Sarana::where('status','1')->get();
        $unique = $collection->unique('kategori');
        $kategori_sarana = $unique->values()->all();
        $saranas = Sarana::where('status','1')->get(['nama','kategori','id']);

        return view('hitung',compact(
            'kategori_indeks','gedungs','indeks','fungsis','jangka_waktu','kategori_sarana','saranas'
        ));
    }

    public function hitungEstimasi(Request $request){
       
        $ktgr = KategoriIndeks::where('status','1')->pluck('slug');

        $ktgr_length = count($ktgr);
        $collect = collect(); 
        $id_ik = collect();

        for($i=0;$i<$ktgr_length;$i++){
            $arr = $ktgr[$i]; // data yg dipake buat nyari id di request
            $bobot_indeks = Indek::where('id',$request->$arr)->value('bobot_indeks');
            $ktgr_id = Indek::where('id',$request->$arr)->value('kategori_indeks_id');
            $bobot_ktgr = KategoriIndeks::where('id',$ktgr_id)->value('bobot_kategori');
            $total_bobot = $bobot_indeks*$bobot_ktgr; // bobotnya kategori sm bobot indeks dikali
            $collect->push($total_bobot);  

            // data request indeks klasifikasi
            $id_ik->push($request->$arr);
        }
        // Hitung Indeks Klasifikasi
        $ik = $collect->sum();

        // Hitung Indeks Terintegrasi
        $fungsi = Indek::where('id',$request->fungsi)->value('bobot_indeks');
        $waktu = Indek::where('id',$request->waktu)->value('bobot_indeks');
        $it = $ik*$fungsi*$waktu;
      
        // Hitung Estimasi Gedung
        $status = Gedung::where('id',$request->gedung)->value('bobot_indeks');
        $biaya = Gedung::where('id',$request->gedung)->value('biaya');
        $luas = $request->luas_bangunan;
        $bangunan_gedung = $luas*$it*$status*$biaya;

        // Hitung Estimasi Sarana
        $namasarana = collect($request->sarana);
        $sarana_length = count($namasarana);

        if($sarana_length > 0){
            $jmlh = collect($request->jumlah_sarana);
            $costs = collect();

            for($i=0;$i<$sarana_length;$i++){
                $biaya_sarana = Sarana::where('nama',$namasarana[$i])->value('biaya');
                $cost = $biaya_sarana * $jmlh[$i];
                $costs->push($cost);

            }
            $total_sarana = $costs->sum();

        } else {
            $total_sarana = 0;
        }
        // Hitung Total Estimasi
        $total_estimasi = $bangunan_gedung + $total_sarana;

        //Input Data Estimasi
        $user_id = Auth::id();

        //Validation
        $valids = [
            'luas_tanah'=>'required',
            'luas_bangunan'=>'required',
            'gedung'=>'required',
            'fungsi'=>'required',
            'waktu'=>'required', 
        ];

        $slugs = KategoriIndeks::pluck('slug');
        $slugs_length = count($slugs);

        for($i=0;$i<$slugs_length;$i++){
            $slug = $slugs[$i];
            $valids[$slug] = 'required';
        }
    
        $request->validate($valids);

        //Input Estimasi
         $estimasi = Estimasi::create([
            'luas_tanah'=>$request->luas_tanah,
            'luas_bangunan'=>$request->luas_bangunan,
            'masyarakats_id'=>$user_id,
            'gedungs_id'=>$request->gedung,
            'total_biaya'=>$total_estimasi,
        ]);

        // Input Data DetailEstimasi
        $id_indeks = $id_ik->push($request->fungsi,$request->waktu);
        foreach($id_indeks as $item){
            DetailEstimasi::create([
                'estimasi_id'=>$estimasi->id,
                'indeks_id'=>$item,
            ]);
        }

        // Input data DetailSarana
        if($sarana_length > 0){
            $jmlh = collect($request->jumlah_sarana);

            for($i=0;$i<$sarana_length;$i++){
                $id_sarana = Sarana::where('nama',$namasarana[$i])->value('id');
                DetailSarana::create([
                    'estimasi_id'=>$estimasi->id,
                    'saranas_id'=>$id_sarana,
                    'jumlah_sarana'=> $jmlh[$i],
                ]);
            }

        }

        $estimasis = Estimasi::where('id',$estimasi->id)->get();
        $detail_estimasis = DetailEstimasi::where('estimasi_id',$estimasi->id)->get();
        $detail_saranas = DetailSarana::where('estimasi_id',$estimasi->id)->get();

        return view('hasil',compact(['estimasis','detail_estimasis','detail_saranas','ik','it','bangunan_gedung','total_sarana']));
    }


    public function riwayatEstimasi(){
        $user_id = Auth::id();
        $estimasis = Estimasi::with(['detailsarana','detail_estimasi'])->where('masyarakats_id',$user_id)->orderBy('created_at','DESC')->paginate(10)->withQueryString();

        return view('riwayat',compact('estimasis'));
    }

    
}
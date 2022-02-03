<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimasi extends Model
{
    use HasFactory;
    protected $table = 'estimasi';
    protected $fillable = ['masyarakats_id','gedungs_id','luas_tanah','luas_bangunan','total_biaya'];

    public function scopeCari($query, array $cari){
        $query->when($cari['search'] ?? false, function($query, $search) {
            return $query->where('total_biaya','like','%'.$search.'%')
                        ->orWhere('created_at','like','%'.$search.'%');
        });
        // $query->when($cari['search'] ?? false, function($query, $search) {
        //     return $query->whereHas('masyarakat' function($query) use($search){
        //                     $query->where('email','like','%'.$search.'%');
        //                 })
        // });
    }

    public function masyarakat(){
        return $this->belongsTo(Masyarakat::class, 'masyarakats_id');
    }
    public function gedungs(){
        return $this->belongsTo(Gedung::class);
    }
    public function detail_estimasi(){
        return $this->hasMany(DetailEstimasi::class, 'estimasi_id', 'id');
    }
    public function detailsarana(){
        return $this->hasMany(DetailSarana::class, 'estimasi_id', 'id');
    }
}

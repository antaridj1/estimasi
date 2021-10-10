<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimasi extends Model
{
    use HasFactory;
    protected $table = 'estimasi';
    protected $fillable = ['masyarakats_id','gedungs_id','luas_tanah','luas_bangunan','total_estimasi'];

    public function masyarakat(){
        return $this->belongsTo(Masyarakat::class);
    }
    public function gedung(){
        return $this->belongsTo(Gedung::class);
    }
    public function detail_estimasi(){
        return $this->hasMany(DetailEstimasi::class);
    }
    public function detail_sarana(){
        return $this->hasMany(DetailSarana::class);
    }
}

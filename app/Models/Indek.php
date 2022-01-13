<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indek extends Model
{
    use HasFactory;
    protected $table = 'indeks';
    protected $attributes = ['status'=>true];
    protected $fillable = ['parameter','kategori_indeks_id','tingkatan','bobot_indeks','keterangan'];

    public function scopeFilter($query, array $filter){
        $query->when($filter['search'] ?? false, function($query, $search) {
            return $query->where('tingkatan','like','%'.$search.'%');            
        });

        $query->when($filter['parameter'] ?? false, function($query, $parameter){
            return $query->where('parameter',$parameter);
        });
    }

    public function kategori_indeks(){
        return $this->belongsTo(KategoriIndeks::class)->withDefault();
    }
    public function detail_estimasi(){
        return $this->hasMany(DetailEstimasi::class);
    }
}

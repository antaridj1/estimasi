<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarana extends Model
{
    use HasFactory;
    protected $table = 'saranas';
    protected $fillable =['nama','kategori','biaya','keterangan'];
    protected $attributes = ['status'=>true];

    public function scopeCari($query, array $cari){
        $query->when($cari['search'] ?? false, function($query, $search) {
            return $query->where('nama','like','%'.$search.'%')
                        ->orWhere('kategori','like','%'.$search.'%');
        });
    }

    public function detail_sarana(){
        return $this->hasMany(\App\Models\DetailSarana::class, 'saranas_id', 'id');
    }

}

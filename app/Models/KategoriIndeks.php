<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriIndeks extends Model
{
    use HasFactory;
    protected $table = 'kategori_indeks';
    protected $attributes = ['status'=>true];
    protected $fillable = ['nama','bobot_kategori','keterangan','slug'];

    public function scopeCari($query, array $cari){
        $query->when($cari['search'] ?? false, function($query, $search) {
            return $query->where('nama','like','%'.$search.'%');
        });
    }

    public function indeks(){
        return $this->hasMany(Indek::class);
    }
}

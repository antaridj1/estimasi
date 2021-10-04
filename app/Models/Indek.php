<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indek extends Model
{
    use HasFactory;
    protected $table = 'indeks';
    protected $attributes = ['status'=>true];
    protected $fillable = ['nama','kategori','tingkatan','bobot_indeks','keterangan'];

    public function estimasis(){
        return $this->hasMany(Estimasi::class);
    }

    public function kategori_indek(){
        return $this->belongsTo(KategoriIndeks::Class);
    }
}

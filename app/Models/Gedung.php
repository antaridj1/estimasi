<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;
    protected $table = 'gedungs';
    protected $fillable =['nama','bobot_indeks','biaya','keterangan'];
    protected $attributes = ['status'=>true];

    public function scopeCari($query, array $cari){
        $query->when($cari['search'] ?? false, function($query, $search) {
            return $query->where('nama','like','%'.$search.'%');
        });
    }

    public function estimasi(){
        return $this->hasMany(Estimasi::class);
    }
}

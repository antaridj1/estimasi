<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimasi extends Model
{
    use HasFactory;
    protected $table = 'estimasi';


    public function masyarakats(){
        return $this->belongsTo(Masyarakat::class);
    }
    public function indeks(){
        return $this->belongsTo(Indek::class);
    }
    public function gedungs(){
        return $this->belongsTo(Gedung::class);
    }
    public function detail_estimasi(){
        return $this->hasMany(DetailEstimasi::class);
    }
}

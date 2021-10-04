<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimasi extends Model
{
    use HasFactory;
    protected $table = 'estimasi';


    public function masyarakat(){
        return $this->belongsTo(Masyarakat::class);
    }
    public function indek(){
        return $this->belongsTo(Indek::class);
    }
    public function gedung(){
        return $this->belongsTo(Gedung::class);
    }
    public function detail_estimasis(){
        return $this->hasMany(DetailEstimasi::class);
    }
}

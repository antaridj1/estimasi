<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEstimasi extends Model
{
    use HasFactory;
    protected $table = 'detail_estimasi';

    public function estimasis(){
        return $this->belongsTo(Estimasi::class);
    }

    public function saranas(){
        return $this->belongsTo(Sarana::class);
    }

}

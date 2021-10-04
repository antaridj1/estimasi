<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEstimasi extends Model
{
    use HasFactory;
    protected $table = 'detail_estimasi';

    public function estimasi(){
        return $this->belongsTo(Estimasi::class);
    }

    public function sarana(){
        return $this->belongsTo(Sarana::class);
    }

}

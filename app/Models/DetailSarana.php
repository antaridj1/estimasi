<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSarana extends Model
{
    use HasFactory;

    protected $table = 'detail_sarana';

    public function estimasi(){
        return $this->belongsTo(Estimasi::class);
    }

    public function sarana(){
        return $this->belongsTo(Sarana::class);
    }
}

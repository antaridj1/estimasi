<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEstimasi extends Model
{
    use HasFactory;
    protected $table = 'detail_estimasi';
    protected $fillable = ['indeks_id','estimasi_id'];

    protected $with = [
        'indeks'
    ];

    public function estimasi(){
        return $this->belongsTo(Estimasi::class);
    }

    public function indeks(){
        return $this->belongsTo(Indek::class, 'indeks_id');
    }

}

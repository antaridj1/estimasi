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

    public function detail_estimasi(){
        return $this->hasMany(DetailEstimasi::class);
    }

}

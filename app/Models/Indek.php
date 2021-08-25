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
}

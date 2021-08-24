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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Masyarakat extends Authenticatable
{
    use HasFactory;
    protected $table = 'masyarakats';
    protected $fillable = ['nama','email','password','telp','no_ktp'];
    protected $attributes = ['status'=>true];
}
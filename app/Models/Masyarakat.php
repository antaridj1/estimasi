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

    public function scopeCari($query, array $cari){
        $query->when($cari['search'] ?? false, function($query, $search) {
            return $query->where('nama','like','%'.$search.'%')
            ->orWhere('telp','like','%'.$search.'%')
            ->orWhere('no_ktp','like','%'.$search.'%')
            ->orWhere('status','like','%'.$search.'%')
            ->orWhere('email','like','%'.$search.'%');
        });
    }

    public function estimasi(){
        return $this->hasMany(Estimasi::class);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password'=> bcrypt('123'),
            'alamat'=> 'hehe',
            'telp'=>'089678678678',
            'status'=>true,
        ]);
    }
}

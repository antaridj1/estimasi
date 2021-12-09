<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Auth;

class MasyarakatController extends Controller
{
    public function index(){
        $user_id = Auth::id();
        $masyarakat = Masyarakat::where('id',$user_id)->get();
        return view('akun',compact('masyarakat'));
    }

    public function edit(Request $request, Masyarakat $masyarakat)
    {
        Masyarakat::where('id',$request->id)->update([
            'nama'=>$request->nama,
            'email'=>$request->email,
            'no_ktp'=>$request->no_ktp,
            'telp' =>$request->telp,
        ]);
        return redirect('/akun');
    }
}

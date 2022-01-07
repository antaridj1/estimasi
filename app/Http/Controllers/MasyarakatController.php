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
        $request->validate([
            'nama'=>'required|max:255',
            'email'=>'required|email|unique:masyarakats|max:255',
            'telp'=>'required|min:10|max:14',
            'no_ktp'=>'required|unique:masyarakats'
        ]);

        Masyarakat::where('id',$request->id)->update([
            'nama'=>$request->nama,
            'email'=>$request->email,
            'no_ktp'=>$request->no_ktp,
            'telp' =>$request->telp,
        ]);
        return redirect('/akun');
    }

    public function tampil(){
        $masyarakats = Masyarakat::all();

        return view('admin.masyarakat',compact('masyarakats'));
    }

    public function editpass(Request $request){
        $user_id = Auth::id();
        $password = Masyarakat::where('id',$user_id)->value('password');

        if(password_verify($request->password_lama, $password) && 
        $request->password_baru == $request->konfirmasi){
            Masyarakat::where('id',$user_id)->update([
                'password'=>bcrypt($request->password_baru)
            ]);
        }else{
            dd('gagal');
        }
        return redirect('/akun');
    }
}

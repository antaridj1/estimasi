<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Estimasi;
use App\Models\Gedung;
use App\Models\Sarana;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index(){
        $jumlah_regis = count(Masyarakat::pluck('id'));
        $jumlah_estimasi = count(Estimasi::pluck('id'));
        $jumlah_gedung = count(Gedung::pluck('id'));
        $jumlah_sarana = count(Sarana::pluck('id'));
        return view('admin.dashboard',compact('jumlah_regis','jumlah_estimasi','jumlah_gedung','jumlah_sarana'));
    }

    public function profil(){
        $user_id = Auth::id();
        $admin = Admin::where('id',$user_id)->get();
        return view('admin.profil',compact('admin'));
    }

    public function edit(Request $request, Admin $admin)
    {
        try{
            $request->validate([
                'nama'=>'required|max:255',
                'email'=>'required|unique:masyarakats|max:255',
                'telp'=>'required|min:10|max:14',
                'alamat'=>'required|max:255'
            ]);

            Admin::where('id',$request->id)->update([
                'nama'=>$request->nama,
                'email'=>$request->email,
                'telp' =>$request->telp,
                'alamat'=>$request->alamat,
            ]);
        } catch (Exception $e) {
            return back()->with('gagal','error');
        }
        return redirect('/profil')->with('update_berhasil','success');
    }

    public function editpass(Request $request){
        $user_id = Auth::id();
        $password = Admin::where('id',$user_id)->value('password');

        $request->validate([
            'password_baru'=>'required|min:3|max:255',
            'password_lama'=>'required|min:3|max:255',
            'konfirmasi'=>'required||min:3|max:255',
        ]);
        
        if(password_verify($request->password_lama, $password) && 
        $request->password_baru == $request->konfirmasi){
            Admin::where('id',$user_id)->update([
                'password'=>bcrypt($request->password_baru)
            ]);
        }else{
            return back()->with('update_gagal','error');
        }
        return redirect('/profil')->with('update_berhasil','success');
    }
}

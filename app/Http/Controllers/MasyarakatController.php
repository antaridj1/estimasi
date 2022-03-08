<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;
use App\Models\Estimasi;
use Illuminate\Support\Facades\Auth;

class MasyarakatController extends Controller
{
    public function index(){
        $user_id = Auth::id();
        $masyarakat = Masyarakat::where('id',$user_id)->get();
        return view('akun',compact('masyarakat'));
    }

    public function edit(Request $request)
    {   
        try{
            $request->validate([
                'nama'=>'required|max:255',
                'email'=>'required|max:255',
                'telp'=>'required|min:10|max:14',
                'no_ktp'=>'required'
            ]);
            
            // $user_id = Auth::id();
            Masyarakat::where('id',$request->id)->update([
                'nama'=>$request->nama,
                'email'=>$request->email,
                'no_ktp'=>$request->no_ktp,
                'telp' =>$request->telp,
            ]);
        } catch (Exception $e) {
            return back()->with('gagal','error');
        }
        return redirect('/akun')->with('update_berhasil','success');
    }

    public function tampil(){
        $masyarakats = Masyarakat::orderBy('id')->cari(request(['search']))->paginate(10)->withQueryString();
        $masyarakat_id = Masyarakat::orderBy('id')->pluck('id');

        $total_estimasi = collect();
        foreach ($masyarakat_id as $key => $value){
            $count = Estimasi::where('masyarakats_id', $value)->count();
            $total_estimasi->put($value , $count);
            
        }
// dd($total_estimasi);
        return view('admin.masyarakat',compact('masyarakats','total_estimasi'));
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
            return back()->with('update_gagal','error');
        }
        return redirect('akun')->with('update_berhasil','success');
    }

    public function updateStatus(Masyarakat $masyarakat)
    {
        $id = $masyarakat->id;

        if( $masyarakat->status == false){
            Masyarakat::where('id',$id)->update([
                'status'=>true,
            ]);
            return redirect('/dashboard/masyarakat')->with('status','data diaktifkan');
        }
        else {
            Masyarakat::where('id',$id)->update([
                'status'=>false,
            ]);
            return redirect('/dashboard/masyarakat')->with('status','data dinonaktifkan');
        }
    }
}

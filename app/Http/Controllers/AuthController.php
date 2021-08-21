<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;
use Auth;

class AuthController extends Controller
{
    public function getRegis(){
        return view('regis');
    }

    public function postRegis(Request $request){
        $request->validate([
            'nama'=>'required',
            'email'=>'required',
            'password1'=>'required',
            'password2'=>'required',
            'telp'=>'required',
            'no_ktp'=>'required'
        ]);

        if($request->password1 == $request->password2){
            Masyarakat::create([
                'nama'=>$request->nama,
                'email'=>$request->email,
                'password'=> bcrypt($request->password1),
                'telp'=>$request->telp,
                'no_ktp'=>$request->no_ktp,
            ]);
            return redirect('login');
        }
        else
            return back();
    }
    
    public function getLogin(){
        return view('login');
    }

    public function postLogin(Request $request){
        $login = $request->validate([
            'email' => ['required','email'],
            'password' => 'required'
        ]);
      //  $login = $request->only('email','password');
       if(Auth::guard('masyarakat')->attempt($login)){
        // $nama = Masyarakat::where('email',$request->email)->value('nama'); 
        // $id = Masyarakat::where('email',$request->email)->value('id');    
        // session(['namaku'=>$nama,'idku' =>$id ]);
        
            $request->session()->regenerate();
           // dd($request->session());
             return redirect()->intended('estimasi');
        }
        else
            return back();
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        session()->invalidate();
        $request->session()->flush();
        session()->regenerateToken();
        return redirect('/login');
    }
}

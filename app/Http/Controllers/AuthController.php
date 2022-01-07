<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;
use App\Models\Admin;
use Auth;

class AuthController extends Controller
{
    public function getRegis(){
        return view('regis');
    }

    public function postRegis(Request $request){
        $request->validate([
            'nama'=>'required|max:255',
            'email'=>'required|email|unique:masyarakats|max:255',
            'password1'=>'required|min:3|max:255',
            'password2'=>'required|min:3|max:255|',
            'telp'=>'required|min:10|max:14',
            'no_ktp'=>'required|unique:masyarakats'
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

       if(Auth::guard('masyarakat')->attempt($login))
       {   
            $request->session()->regenerate();
             return redirect()->intended('estimasi');
        }
        else if(Auth::guard('admin')->attempt($login)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
         else{
            return back();
         }
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

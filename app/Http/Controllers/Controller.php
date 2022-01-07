<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Auth;
use View;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function __construct(){
    //     dd(Auth::check());
    //     //     $hehe = Auth::user()->value('nama');
    //     // }else{
    //     //     $hehe = null;
    //     // }       
    //     View::share('hehe', $hehe);
    // }
}

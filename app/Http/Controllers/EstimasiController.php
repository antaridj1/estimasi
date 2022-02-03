<?php

namespace App\Http\Controllers;

use App\Models\Estimasi;
use Illuminate\Http\Request;

class EstimasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estimasis = Estimasi::orderBy('created_at','DESC')->cari(request(['search']))->paginate(10)->withQueryString();
        return view('admin.estimasi',compact('estimasis'));
    }

}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use App\Tilaus;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TilausController extends Controller
{

    public function list_all()
    {
        $tilaukset = Tilaus::All();
        return view('tilaus')->with('tilaukset', $tilaukset);
    }

}

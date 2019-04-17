<?php

namespace App\Http\Controllers;

use App\User;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NaisetController extends Controller
{

    public function list_all()
    {
	$PDO = DB::connection('mysql')->getPdo();

	$sql = <<< SQLEND
	SELECT *
	FROM Tuote WHERE gender = 'naiset'
SQLEND;

	$allsql = $PDO->prepare($sql);

	$allsql->execute();

        // Muista TÄMÄ FETCH_OBJ
	$naiset = $allsql->fetchAll((\PDO::FETCH_OBJ));
    //return $naiset;

    return view('naiset')->with('naiset', $naiset);
        
}

}


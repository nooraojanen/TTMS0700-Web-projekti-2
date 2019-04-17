<?php

namespace App\Http\Controllers;

use App\User;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiehetController extends Controller
{

    public function list_all()
    {
	$PDO = DB::connection('mysql')->getPdo();

	$sql = <<< SQLEND
	SELECT *
	FROM Tuote WHERE gender = 'miehet'
SQLEND;

	$allsql = $PDO->prepare($sql);

	$allsql->execute();

        // Muista TÄMÄ FETCH_OBJ
	$miehet = $allsql->fetchAll((\PDO::FETCH_OBJ));
    //return $miehet;

    return view('miehet')->with('miehet', $miehet);
        
}

}


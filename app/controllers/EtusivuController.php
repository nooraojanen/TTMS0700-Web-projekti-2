<?php

namespace App\Http\Controllers;

use App\User;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtusivuController extends Controller
{

    public function list_all()
    {
	$PDO = DB::connection('mysql')->getPdo();

	$sql = <<< SQLEND
	SELECT *
	FROM Tuote 
SQLEND;

	$allsql = $PDO->prepare($sql);

	$allsql->execute();

        // Muista TÄMÄ FETCH_OBJ
	$etusivu = $allsql->fetchAll((\PDO::FETCH_OBJ));
    //return $etusivu;

    return view('etusivu')->with('etusivu', $etusivu);
        
}

}


<?php

namespace App\Http\Controllers;

use App\User;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller {
 
     public function index()
      	{
			$hakuehto = isset($_GET['query']) ? $_GET['query'] : '';

			/*echo $hakuehto;*/
			$PDO = DB::connection('mysql')->getPdo();


				$sql = <<<SQLEND
				SELECT tuotteennimi, hinta, gender, TuoteID, tuotteenkuva
				FROM Tuote WHERE tuotteennimi
				LIKE :hakuehto
SQLEND;
			 
$stmt = $PDO->prepare($sql);
$h = "%$hakuehto%";
$stmt->bindParam(':hakuehto', $h, \PDO::PARAM_STR);
$stmt->execute();
$tulokset = $stmt->fetchAll((\PDO::FETCH_OBJ));
//return $tulokset; 
return view('search')->with('tulokset', $tulokset);
	}
}
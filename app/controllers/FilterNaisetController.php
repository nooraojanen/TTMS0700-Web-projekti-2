<?php

namespace App\Http\Controllers;

use App\User;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FilterNaisetController extends Controller {
 
     public function index()
      	{
			$kategoria = isset($_GET['kategoria']) ? $_GET['kategoria'] : '';
			$hintamin = isset($_GET['hintamin']) ? $_GET['hintamin'] : '';
			$hintamax = isset($_GET['hintamax']) ? $_GET['hintamax'] : '';

			/*return $kategoria;*/
			$PDO = DB::connection('mysql')->getPdo();


				$sql = <<<SQLEND
				SELECT tuotteennimi, hinta, gender, TuoteID, tuotteenkuva
				FROM Tuote WHERE FK_TuoteryhmaID = :kategoria 
				AND gender = 'naiset'
				AND hinta > :hintamin
				AND hinta < :hintamax
				
SQLEND;
			 
$stmt = $PDO->prepare($sql);
/*$h = "%$hakuehto%";*/
$stmt->bindParam(':kategoria', $kategoria, \PDO::PARAM_STR);
$stmt->bindParam(':hintamin', $hintamin, \PDO::PARAM_STR);
$stmt->bindParam(':hintamax', $hintamax, \PDO::PARAM_STR);
$stmt->execute();
$filternaiset = $stmt->fetchAll((\PDO::FETCH_OBJ));
//return $filternaiset; 
return view('filternaiset')->with('filternaiset', $filternaiset);
	}
}
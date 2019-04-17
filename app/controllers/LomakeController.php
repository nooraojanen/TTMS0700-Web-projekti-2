<?php

namespace App\Http\Controllers;

use App\User;
use App\Lomake;
//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LomakeController extends Controller
{

   public function lomake() {
        return view('lomake');

    }

    public function store(Request $request) {
        Lomake::create($request->all());
       return redirect('/yhteenveto'); 
	session_start();
	var_dump($_SESSION['kori']);

$PDO = DB::connection('mysql')->getPdo();
$aika = date("Y-m-d h:i:s");

$sql = <<< SQLEND
	SELECT MAX(AsiakasID) AS maxid from Asiakas
SQLEND;


$newestCustomer = $PDO->prepare($sql);
$newestCustomer->execute();
$nc = $newestCustomer->fetchAll((\PDO::FETCH_OBJ)); // Muista TÄMÄ FETCH_OBJ

//return $nc[0]->maxid;

$tilaajaID = $nc[0]->maxid;
//echo $tilaajaID;

var_dump($_SESSION['kori']);
foreach ($_SESSION['kori'] as $tilattu) {

			$sql = "INSERT INTO Tilaus (FK_asiakasID, FK_tuoteID, tilausaika) VALUES(:f1, :f2, :f3)";
                        echo $sql;
			$insertsql = $PDO->prepare($sql);
			$insertsql->execute(array(':f1' => $tilaajaID,  ':f2' => $tilattu, ':f3' => $aika));

	

}

/*
	

*/

	
    }        
}



// tilausvahvistus
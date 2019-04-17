<?php

namespace App\Http\Controllers;

use App\Tilaus;
use App\Korissa;
//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YhteenvetoController extends Controller
{

   public function yhteenveto() {
//haetaan viimeksi lisätty asiakasID
$PDO = DB::connection('mysql')->getPdo();
$aika = date("Y-m-d h:i:s");

$sql = <<< SQLEND
	SELECT MAX(AsiakasID) AS maxid from Asiakas
SQLEND;


$newestCustomer = $PDO->prepare($sql);
$newestCustomer->execute();
$nc = $newestCustomer->fetchAll((\PDO::FETCH_OBJ)); // Muista TÄMÄ FETCH_OBJ

$tilaajaID = $nc[0]->maxid;

$sql = <<< SQLEND
	SELECT * from Asiakas WHERE asiakasID = :tilaajaID
SQLEND;
			$sqlresult = $PDO->prepare($sql);
			$sqlresult ->execute(array(':tilaajaID' => $tilaajaID));
			$tilaaja = $sqlresult->fetchAll((\PDO::FETCH_OBJ)); 

$ostaja = $tilaaja[0];
$ostaja = json_decode(json_encode($ostaja), true);


	/*$id = DB::getPdo()->lastInsertId();;
        $tilaukset = Tilaus::All();
        return view('tilaus')->with('tilaukset', $tilaukset);*/

	session_start();
	
    if (isset($_SESSION['kori'])){	
       
        if (count($_SESSION['kori'])!=0){
        
		
		$tuotejson=array();
        $montako = 0;
        $laske = array_count_values($_SESSION['kori']);
       
        
		foreach ($_SESSION['kori'] as $osto) {
			$ostokset = Korissa::all();
			$json = $ostokset;
			foreach ($json as $item) {
    			if ($item["TuoteID"] == $osto) {

       			$nimi = $item["tuotteennimi"];
				$hinta = $item["hinta"];
				$tunniste = $item["TuoteID"];
				$kuvatus = $item["tuotteenkuva"];
				$uusitieto['tuotenimi'] = $nimi;
				$uusitieto['tuotteenkuva'] = $kuvatus;

				
                if($laske[$item["TuoteID"]] >= 1){
                $uusitieto['hinta'] = $hinta*$laske[$item["TuoteID"]];
                
                }
				
				$uusitieto['tunniste'] = $tunniste;
				if ($laske[$item["TuoteID"]] <= 5){
                		$uusitieto['lkm'] = $laske[$item["TuoteID"]];
				}
				else {
				$uusitieto['lkm'] = 5;
				}
				array_push($tuotejson,$uusitieto);
        			break;	
    			}
		
			}
		
		}
        //var_dump($_SESSION['kori']);
    	$asiakasjson=array();
	$etunimi = $ostaja["etunimi"];
	$sukunimi = $ostaja["sukunimi"];
	$uusiostaja['etunimi'] = $etunimi;
	$uusiostaja['sukunimi'] = $sukunimi;

	array_push($asiakasjson,$ostaja);
	$ostaja = json_encode($asiakasjson);
	$unique = array_map('unserialize', array_unique(array_map('serialize', $tuotejson)));
	$kaikki = json_encode($unique);
	
	session_destroy();
	return view('yhteenveto', ['kaikki' => $kaikki], ['ostaja' => $ostaja]);
            }
        else {
            $tyhja = "korisi on tyhja";
		      return view('yhteenveto')->with('tyhja',$tyhja);
        }
	}
	if (empty($_SESSION['kori'])){
		$tyhja = "korisi on tyhja";
		return view('yhteenveto')->with('tyhja',$tyhja);
	}



        return view('yhteenveto');
    }



}



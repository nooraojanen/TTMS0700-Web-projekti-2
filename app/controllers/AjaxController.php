<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Korissa;

class AjaxController extends Controller
{
public function tulosta(Request $request) {	
	$tuoteid = $request->id;
	//echo $tuoteid;
	session_start();
	$_SESSION['kori'][]=$tuoteid;
    $laskutoi = array_count_values($_SESSION['kori']);
    
    if (in_array($tuoteid,$_SESSION['kori'])){
        if($laskutoi[$tuoteid] > 5){
            
            
            $nollaa = $tuoteid;
            foreach (array_keys($_SESSION['kori'],$nollaa,true) as $key){
		      unset($_SESSION['kori'][$key]); 
                
               
	           }
             $_SESSION['kori'] = array_values($_SESSION['kori']);
            $laskuri = 0;
            for($a=0; $a<$laskutoi[$tuoteid]; $a++){
                echo "lasketaan";
               if($a == 5){
                    break;
                }
                $_SESSION['kori'][]=$tuoteid;
            }
            
        }
        var_dump($_SESSION['kori']);
         $laskutoi = array_count_values($_SESSION['kori']);
        print_r($laskutoi);
    }
    
	}

public function naytakori() {
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
    	$unique = array_map('unserialize', array_unique(array_map('serialize', $tuotejson)));
	$kaikki = json_encode($unique);
	return view('tulostakori', ['kaikki' => $kaikki]);
            }
        else {
            $tyhja = "korisi on tyhjä";
		      return view('tulostakori')->with('tyhja',$tyhja);
        }
	}
	if (empty($_SESSION['kori'])){
		$tyhja = "korisi on tyhjä";
		return view('tulostakori')->with('tyhja',$tyhja);
	}
}
public function vieyhteen() {
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
				$kuvatus = $item["tuotteenkuva"];
				$tunniste = $item["TuoteID"];
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
    	$unique = array_map('unserialize', array_unique(array_map('serialize', $tuotejson)));
	$kaikki = json_encode($unique);
	return view('lomake', ['kaikki' => $kaikki]);
            }
        else {
            $tyhja = "korisi on tyhjä";
		      return view('lomake')->with('tyhja',$tyhja);
        }
	}
	if (empty($_SESSION['kori'])){
		$tyhja = "korisi on tyhjä";
		return view('lomake')->with('tyhja',$tyhja);
	}
    
}

public function poistakorista(Request $request){
	$poistoid = $request->id;	
	session_start();
	
	echo "poistetaan :";
	foreach (array_keys($_SESSION['kori'],$poistoid,true) as $key){
		unset($_SESSION['kori'][$key]);
	}
	

    	$_SESSION['kori'] = array_values($_SESSION['kori']);
	   var_dump($_SESSION['kori']);
	echo $poistoid;
	}
public function muutalkm(Request $request){
    
	$varmistaid = $request->varmista;
	$muutalkm = $request->muuta;
	echo $varmistaid;
    $korjattu = (int)$muutalkm;
    echo $korjattu;
	session_start();
    $vaihto = array_count_values($_SESSION['kori']);
    if (in_array($varmistaid,$_SESSION['kori'])){
            $nollaa = $varmistaid;
            foreach (array_keys($_SESSION['kori'],$nollaa,true) as $key){
		      unset($_SESSION['kori'][$key]); 
	           }
        
             $_SESSION['kori'] = array_values($_SESSION['kori']);
            for($i=0; $i<$korjattu; $i++){
                
               if($i == $korjattu){
                   
                    break;
                   
                }
                $_SESSION['kori'][]=$varmistaid;
            }
            
        
        //var_dump($_SESSION['kori']);
        var_dump($_SESSION['kori']);
         $vaihto = array_count_values($_SESSION['kori']);
        print_r($vaihto);
        
        echo "toimii";
    }
}
}

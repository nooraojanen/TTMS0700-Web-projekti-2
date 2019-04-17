@extends('layouts.app')

@section('content')
<head>
	<style>
	#yhteenveto {
	border-style: solid;
	width: 40%; 
	margin-top: 40px;
	margin-left:	100px;

	}
	.Shoppingcart {
	border-style: double;
	width: 100%;
	margin-right: 0px;
	margin-left: 0px;
	}
	.centerkeski{
	text-align: center;
	margin-top: 200px;
	margin-bottom: 200px;
	}
	.kuvaset{
	width: 100%;
	}
	.valitys {
		padding-right: 0px;
	padding-left: 0px;

	}
	.header {
	vertical-align: middle;
	}
	#ostajaid {
	padding-left: 100px;
	
	}
	h1 {
	padding-left: 100px;
	}
	#etus{
	margin-left: 100px;
	margin-top: 20px;
	margin-bottom: 100px;
	}
	      </style>

</head>
<body onload="NaytaTuotteet()">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>

<h1>Tilauksen yhteenveto</h1>
<div id="ostajaid"></div>
<div id="yhteenveto"></div>
<a href="/etusivu" class="btn btn-success" id="etus">Palaa etusivulle</a>

</body>


<script>
function NaytaTuotteet(){
@isset($_SESSION['kori'])
    @if (count($_SESSION['kori'])!= 0)
var something = <?php echo json_encode($kaikki);?>;
var something2 = <?php echo json_encode($ostaja);?>;
console.log(something);
console.log(something2);
var ostajaa = jQuery.parseJSON(something2);

$.each(ostajaa, function(key,value){
var ostajadiv = document.createElement('div');


var ostajaotsikko = document.createElement('h2');
$(ostajaotsikko).append("Omat tietosi:");
var ostajapvm = document.createElement('p');
$(ostajapvm).append("Tilaus tehty : " +value.created_at);


var ostajanimi = document.createElement('p');
var ostajaosoite = document.createElement('p');
var ostajaposti = document.createElement('p');
var ostajapuhnro = document.createElement('p');

$(ostajanimi).append(value.etunimi + " " + value.sukunimi);
$(ostajaposti).append(value.sposti);
$(ostajapuhnro).append(value.puhnmr);
$(ostajaosoite).append(value.osoite + " " + value.postinumero + " " + value.kaupunki);
ostajadiv.append(ostajapvm, ostajaotsikko, ostajanimi, ostajaosoite,ostajaposti, ostajapuhnro);
$("#ostajaid").append(ostajadiv);
});


var korissa = jQuery.parseJSON(something);
var div2 = document.createElement('div');
	div2.setAttribute("class","valitys container");
	$("#yhteenveto").append(div2);
	var otsikkoyhteenvet = "Tilaamasi tuotteet:";
 	var otsikkoyhteenv = document.createElement('h2');
  	otsikkoyhteenv.setAttribute("class","otsikkoyhteenv");
   	 otsikkoyhteenv.innerHTML=otsikkoyhteenvet;
	div2.append(otsikkoyhteenv);

$.each(korissa, function(key, value){
	var div = document.createElement('div');
	div.setAttribute("id",value.tunniste +"ba");
	div.setAttribute("class","Shoppingcart row align-items-center");
	var header = document.createElement('p');
	$(header).append(value.tuotenimi);
	header.setAttribute("class", "header");
	var headerdiv = document.createElement('div');
	headerdiv.setAttribute("class", "headerdiv2 col");
	$(headerdiv).append(header);

	var hinta = document.createElement('p');
        $(hinta).append(parseFloat(Math.round(value.hinta * 100) / 100).toFixed(2)+"€");
    hinta.setAttribute("class","hinta");
	var hintadiv = document.createElement('div');
	hintadiv.setAttribute("class", "hintadiv2 col");
	$(hintadiv).append(hinta);

   
    
    	var lkm = document.createElement('p');
        lkm.innerHTML=value.lkm;
   	var lkmdiv = document.createElement('div');
	lkmdiv.setAttribute("class", "lkmdiv2 col");
	$(lkmdiv).append(lkm);
	var kuvanen = document.createElement('img');
	kuvanen.setAttribute("class","kuvaset");
	kuvanen.setAttribute("src","tuotekuvat/"+value.tuotteenkuva);
	var kuvanendiv = document.createElement('div');
	kuvanendiv.setAttribute("class", "kuvanendiv2 col");
	$(kuvanendiv).append(kuvanen);


    
    var yhteis = parseFloat(Math.round(value.hinta * 100) / 100).toFixed(2);
    var summanlasku = document.createElement('p');
    summanlasku.setAttribute("class","summanlasku");
    $(summanlasku).append(yhteis);
    summanlasku.style.display = "none";
	div.append(kuvanendiv,headerdiv,hintadiv,summanlasku,lkmdiv);
	div2.append(div);	

    
});
 haehinta();


    @endif
@endisset
@empty($_SESSION['kori'])
var tyhja = "<?php echo $tyhja;?>";
console.log("Onnistuin?");
var tyhjaarvo = document.createElement('p');
   tyhjaarvo.setAttribute("class","tyhjaarvo");
    $(tyhjaarvo).append(tyhja);
	$("#yhteenveto").append(tyhjaarvo);
	document.getElementById("yhteenveto").style.borderStyle = "none";

@endempty

}
function haehinta(){
   
    var hinta = document.getElementsByClassName("summanlasku");
    console.log(hinta);
    var loppusumma = 0;
    for (i = 0; i < hinta.length; i++) {
        var hi;
        hi = hinta[i].innerHTML;
        hi = parseFloat(hi);
        loppusumma = loppusumma + hi;
        console.log(hi);
    }
    console.log(loppusumma);
	var hintayhteensa = "ostokset yhteensä: "+ parseFloat(Math.round(loppusumma * 100) / 100).toFixed(2)+"€";
 	var lopetussumma = document.createElement('p');
   lopetussumma.setAttribute("class","lopetussumma");
    $(lopetussumma).append(hintayhteensa);
	$("#yhteenveto").append(lopetussumma);
    }



</script>
@endsection
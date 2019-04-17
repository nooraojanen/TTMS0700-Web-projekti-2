@extends('layouts.app')

@section('content')
<head>
	<style>
	#yhteenveto {
	border-style: solid;
	width: 40%; 
	margin-top: 40px;
	margin-left: 20%;

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
	      </style>

</head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<body onload="NaytaTuotteet()">

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<div id="yhteenveto"></div>
<div class="container p-3">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
        <h2 id="uploadhead">Asiakkaan tiedot</h2>
        <hr/>
            <form role="form" data-toggle="validator" method="POST" action="/lomake">

<div class="form-row">
	<div class="form-group col-md-6">
      		<label for="etunimi">Etunimi</label>
      		<input type="text" class="form-control" id="etunimi" name="etunimi" placeholder="Etunimi" required autofocus>
    	</div>
    	<div class="form-group col-md-6">
      		<label for="sukunimi">Sukunimi</label>
      		<input type="text" class="form-control" id="sukunimi" name="sukunimi" placeholder="Sukunimi" required autofocus>
    	</div>
</div>

<div class="form-row">
        <div class="form-group col-md-12 col-md-offset-1">
  		<label for="osoite">Katuosoite</label>
        	<input id="osoite" type="text" class="form-control" name="osoite" placeholder="Katuosoite" required autofocus>
       </div>
</div>

<div class="form-row">
	<div class="form-group col-md-6">
      		<label for="etunimi">Postinumero</label>
      		<input type="text" class="form-control" id="postinumero" name="postinumero" placeholder="Postinumero" required autofocus>
    	</div>
	<div class="form-group col-md-6">
      		<label for="sukunimi">Kaupunki</label>
      		<input type="text" class="form-control" id="kaupunki" name="kaupunki" placeholder="Kaupunki" required autofocus>
    	</div>
</div>

<div class="form-row">
        <div class="form-group col-md-12 col-md-offset-1">
  		<label for="puhnmr">Puhelin</label>
        	<input id="puhnmr" type="text" class="form-control" name="puhnmr" placeholder="Puhelinnumero" required autofocus>
       </div>
</div>


<div class="form-row">
        <div class="form-group col-md-12 col-md-offset-1">
  		<label for="sposti">Email</label>
        	<input id="sposti" type="text" class="form-control" name="sposti" placeholder="Email" required autofocus>
       </div>
</div>

<div class="form-row">
        <div class="form-group col-md-12 col-md-offset-1">
  		<label for="sposti">Salasana</label>
        	<input id="salasana" type="text" class="form-control" name="salasana" placeholder="Salasana" required autofocus>
       </div>
</div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck" required>
      <label class="form-check-label" for="gridCheck">
        Hyvaksyn toimitusehdot, uutiskirjeen tilauksen ja myyn sieluni Kauppa X:lle
      </label>
    </div>
  </div>
                
  <button type="submit" class="btn btn-primary">Valmis</button>


                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>

                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
<script>
function NaytaTuotteet(){
@isset($_SESSION['kori'])
    @if (count($_SESSION['kori'])!= 0)
var something = <?php echo json_encode($kaikki);?>;
console.log(something);
var korissa = jQuery.parseJSON(something);
var div2 = document.createElement('div');
	div2.setAttribute("class","valitys container");
	$("#yhteenveto").append(div2);
	var otsikkoyhteenvet = "Olet ostamassa";
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
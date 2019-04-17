@extends('layouts.app')

@section('content')

  <head>
<meta name="csrf-token" content="{{ csrf_token() }}">
      <meta charset="UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
      <style>
          .valitse option{
              background-color:#F0EDB6;
          }
          .valitse {
              width: 35px;
          }
	#korissa {
		width: 70%; 
	margin-right: 15%;
	margin-left: 15%;
	margin-top: 40px;
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
	#meetilaukseen{
	width: 70%;
	margin-right: 15%;
	margin-left: 15%;
	margin-top: 15px;
	margin-bottom: 15px;
	}
	.summaolemassa {
	width: 70%;
	margin-right: 15%;
	margin-left: 15%;
	margin-top: 15px;
	margin-bottom: 15px;
	}
	.kuvaset{
	width: 80%;
	}
	.header {
	vertical-align: middle;
	}
	#ostoskoriotsikko{
	padding-top: 25px;
	text-align: center;
	}
	.valitys1 {
		padding-right: 0px;
	padding-left: 0px;

	}
.jatkatilaus {
	margin-bottom: 100px;
	}

	      </style>
  </head>
  <body onload="NaytaOstokset()">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
      
<h2 id="ostoskoriotsikko">Ostoskorisi</h2>      
<div id="korissa"></div>
<p id="summa"></p>
<div id="meetilaukseen"></div>
         
  </body>
<script>

function NaytaOstokset (){
@isset($_SESSION['kori'])
    @if (count($_SESSION['kori'])!= 0)
var something = <?php echo json_encode($kaikki);?>;
console.log(something);
	//var div1 = document.createElement('div');
	//div1.setAttribute("class","row");
	var div2 = document.createElement('div');
	div2.setAttribute("class","valitys1 container");
	//div2.append(div1);
	$("#korissa").append(div2);
var korissa = jQuery.parseJSON(something);
$.each(korissa, function(key, value){
	var div = document.createElement('div');
	div.setAttribute("id",value.tunniste +"b");
	div.setAttribute("class","Shoppingcart row align-items-center");
	var header = document.createElement('p');
	$(header).append(value.tuotenimi);
	header.setAttribute("class", "header");
	var headerdiv = document.createElement('div');
	headerdiv.setAttribute("class", "headerdiv col");
	$(headerdiv).append(header);
	var hinta = document.createElement('p');
        $(hinta).append(parseFloat(Math.round(value.hinta * 100) / 100).toFixed(2)+"€");
    hinta.setAttribute("class","hinta");
	var hintadiv = document.createElement('div');
	hintadiv.setAttribute("class", "hintadiv col");
	$(hintadiv).append(hinta);

	var poista = document.createElement('a');
	poista.setAttribute("id",value.tunniste+"poisto");
	poista.setAttribute("class","poista btn btn btn-danger");
	poista.setAttribute("onclick","Myfunction(this.id)");
	$(poista).append("poista korista");
	var roska = document.createElement('i');
	roska.setAttribute("class","fas fa-trash");
	$(poista).append(roska);
	var poistadiv = document.createElement('div');
	poistadiv.setAttribute("class", "poistadiv col");
	$(poistadiv).append(poista);

   	var kuvanen = document.createElement('img');
	kuvanen.setAttribute("class","kuvaset");
	kuvanen.setAttribute("src","tuotekuvat/"+value.tuotteenkuva);
	var kuvanendiv = document.createElement('div');
	kuvanendiv.setAttribute("class", "kuvanendiv col");
	$(kuvanendiv).append(kuvanen);

    
    	var lkm = document.createElement('select');
        lkm.setAttribute('id',value.tunniste +"lkm");
        lkm.setAttribute('onchange',"myChange(this.id)");
        lkm.setAttribute("class","valitse");
        var op1 = document.createElement('option');        
        $(op1).append(1);
        var op2 = document.createElement('option');
        $(op2).append(2);
        var op3 = document.createElement('option');
        $(op3).append(3);
        var op4 = document.createElement('option');
        $(op4).append(4);
        var op5 = document.createElement('option');
        $(op5).append(5);
   
    if (value.lkm < 5){
        if (value.lkm < 4){
            if(value.lkm < 3){
                if(value.lkm < 2){
                    op1.setAttribute('selected','');
                }else{
                    op2.setAttribute('selected','');
                }
            }else{
                op3.setAttribute('selected','');
            }
        }else{
            op4.setAttribute('selected','');
        }
    }else{
        op5.setAttribute('selected','');
    }
    
    
    lkm.append(op1,op2,op3,op4,op5);
   	var lkmdiv = document.createElement('div');
	lkmdiv.setAttribute("class", "lkmdiv col");
	$(lkmdiv).append(lkm);
    
    var yhteis = parseFloat(Math.round(value.hinta * 100) / 100).toFixed(2);
    var summanlasku = document.createElement('p');
    summanlasku.setAttribute("class","summanlasku");
    $(summanlasku).append(yhteis);
    summanlasku.style.display = "none";
	div.append(kuvanendiv,headerdiv,hintadiv,summanlasku,lkmdiv,poistadiv,);
	div2.append(div);
		document.getElementById("summa").setAttribute("class", "summaolemassa");

    
});
    haehinta();

    var tilaukseen = document.createElement('a');
	tilaukseen.setAttribute("class","btn btn-success jatkatilaus");
	tilaukseen.setAttribute("href","{{ url('/lomake') }}");
	$(tilaukseen).append("Jatka tilaukseen");
	$("#meetilaukseen").append(tilaukseen);
	
    @endif
@endisset
@empty($_SESSION['kori'])
var tyhja = "<?php echo $tyhja;?>";
document.getElementById("summa").innerHTML = tyhja;
var keski = document.getElementById("summa");
keski.setAttribute('class','centerkeski');
console.log("Onnistuin?");
var poistakor = document.getElementById("korissa");
poistakor.parentNode.removeChild(poistakor);
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
document.getElementById("summa").innerHTML = "Ostokset yhteensä: "+parseFloat(Math.round(loppusumma * 100) / 100).toFixed(2)+"€";
    }

function Myfunction(clicked_id){
    
	var id = clicked_id;
    id = parseInt(id);
	var poista;
	poista = id + "b";
	console.log(poista);
	console.log(id);
    	$("#"+poista).remove();
	console.log("hallloo");
	$.ajax({
        	type: "POST",
        	url: 'poistaostoskorista',
       	data: {id:id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       success: function(response){ 
        	console.log(response); location.reload();},
    	error: function(jqXHR, textStatus, errorThrown) { 
        	console.log(JSON.stringify(jqXHR));
        	console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    }
 });
	
haehinta();
 }
function myChange(idee){
	var muuta = document.getElementById(idee).value;
    var muuta = parseInt(muuta);
	var varmista = parseInt(idee);
	
	$.ajax({
        	type: "POST",
        	url: 'muutalkm',
       	data: {varmista:varmista,muuta:muuta},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       success: function(response){ 
        	console.log(response); location.reload();},
    	error: function(jqXHR, textStatus, errorThrown) { 
        	console.log(JSON.stringify(jqXHR));
        	console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    }
	});

}


</script>
@endsection
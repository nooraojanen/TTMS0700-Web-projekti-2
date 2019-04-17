@extends('layouts.app')

@section('content')
<style>
          #listatty {
              z-index: 2;
              position: fixed;
              display: none;
              font-weight: bold;
              top: 90%;
              background-color: #90EE90; 
              padding-top: 7px;
              margin-bottom: 4px;
              padding-right: 4px;
              padding-left: 4px;
          }

      </style>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>

<div class="container text-center">
<h1>HAKUTULOKSET</h1>
</div>

<body class="text-center">
  

<p></p>
        </div> 
    </div>
    <div class="container mx-auto">
    <div class="col-sm">

      <div class="row ">
    <div class="col-sm ">
    @foreach ($tulokset as $tulos)
    
    <div class="col-sm border border-dark ">
    <img src="tuotekuvat/{{ $tulos->tuotteenkuva }}" style="max-width:200px"> {{ $tulos->tuotteennimi }} <br>{{ $tulos->hinta }} € <a href='#'class="btn btn-success lisaa" id="{{ $tulos->TuoteID }}">Lisaa Ostoskoriin</a> 
</div> <br>

@endforeach
    </div>
    </div>
  </div>
    </div>
  </div>
</div>
<p></p>
<div id="listatty"></div>

</body>
<script>
 $('.lisaa').click(function(){
	var id = $(this).attr('id');
	console.log(id);
	$.ajax({
        type: "POST",
        url: 'lisaaostoskoriin',
        data: {id:id},
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
        success: function(response){ 
        console.log(response);
lisatty();
 
    },
    error: function(jqXHR, textStatus, errorThrown) { 
        console.log(JSON.stringify(jqXHR));
        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
	alert("Tapahtui virhe :( Yrit� uudelleen");
    }
 });
 });
function lisatty() {
    console.log("jees");
    var ilmoitus = document.createElement('div');
    var ilmoitustext = document.createElement('p');
    
    ilmoitustext.setAttribute("id","ilmoita");
    ilmoitus.append(ilmoitustext);
	
	$("#listatty").append(ilmoitus);
    //document.getElementById("listatty").style.zIndex = "2";
    document.getElementById("ilmoita").innerHTML = "tuote on lisätty ostoskoriisi";
    $("#listatty").fadeIn("slow");
    var myVar = setTimeout(lisattypoisto, 500);
}
function lisattypoisto(){
    
    $("#listatty").fadeOut("slow");
}

</script>

@endsection
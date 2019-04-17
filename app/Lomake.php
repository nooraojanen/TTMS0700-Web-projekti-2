<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lomake extends Model
{
protected $table = "Asiakas";
      protected $fillable = [
		'etunimi',
		'sukunimi',
		'osoite',
		'postinumero',
		'kaupunki',
		'puhnmr',
		'sposti',
		'salasana'
	];


}
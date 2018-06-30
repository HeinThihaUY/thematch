<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;

class PlaceController extends Controller
{
   	public function getPlaces(){
   		$places = Place::all();
   		return $places;
   	}
}

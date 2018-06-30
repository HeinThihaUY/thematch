<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
   	public function getPlayer(){
   		$json =	request()->getContent();
   		$data = json_decode($json);
   		$id = 0;
   		if(isset($data->id)){
   			$id = $data->id;
   		}
   		$player =Player::find($data->id);
   		return $player;
   	}
}

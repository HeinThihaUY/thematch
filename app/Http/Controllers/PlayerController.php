<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use DB;

class PlayerController extends Controller
{
	public function getPlayer(){
		$player_id = request('playerId');
		$player =Player::find($player_id);
		return $player;
	}

   public function getAllOtherPlayers(){
      $player_id = request('playerId');
      $other_players = DB::table('players')->whereNotIn('id', [$player_id])->get();
      // dd($other_players);
      return $other_players;
   }

   public function getPlayersForRecurite(){
      $team_id = request('teamId');
      $recurite_players = DB::table('team_details')
                           ->selectRaw('players.*')
                           ->leftJoin('players', 'team_details.player_id', '=', 'players.id')
                           ->whereNotIn('team_details.team_id', [$team_id])
                           ->get();
      // dd($recurite_players);
      return $recurite_players;
   }

   public function getTeamPlayers(Request $request)
    {
      $team_id = $request->input('teamId');
      $team_members = DB::table('team_details')
                        ->selectRaw('players.*')
                        ->leftJoin('players', 'team_details.player_id', '=', 'players.id')
                        ->where('team_details.team_id', $team_id)->get();
      return $team_members;
    }
}

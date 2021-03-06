<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;
use App\Models\Team_detail;
use App\Models\Player_Invitation;
use DB;

class PlayerController extends Controller
{
	public function getPlayer(){
		$player_id = request('playerId');
		$player = Player::find($player_id);
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

	 public function getPlayerTeams(Request $request)
	 {
	 		$pId = $request->playerId;
			$teams = Team_detail::where('player_id', $pId)->get();
			return $this->getTeams($teams, $pId);
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

		private function getTeams($c_team, $pId)
	  {
	      $teams = array();
	      foreach ($c_team as $c) {
	        array_push($teams, $this->getTeamObj($c, $pId));
	      }
	      return $teams;
	  }

	  private function getTeamObj($team, $pid)
	  {
			$_t = Team::where('id',$team->team_id)->get()->first();
	      $t = new \stdClass();
	      $t->id = $team->team_id;
	      $t->name = $_t->name;
	      $t->point = $_t->point;
	      $t->isLeader = ($pid == $_t->leader) ? true : false;
	      $t->logo_url = $_t->logo_url;
	      return $t;
	  }

   public function acceptTeam(){
      $team_id = request('teamId');
      $player_id = request('playerId');
      // dd($player_id);
      Team_detail::create([
         "team_id" => $team_id,
         "player_id" => $player_id
      ]);

      Player_Invitation::where('team_id', $team_id)->where('player_id', $player_id)->delete();

      return response()->json(['success'=> 'team member added, invitation deleted']);
   }

   public function declineTeam(){
      $team_id = request('teamId');
      $player_id = request('playerId');
      Player_Invitation::where('team_id', $team_id)->where('player_id', $player_id)->delete();

      return response()->json(['success'=> 'invitation deleted']);
   }

   public function getInvitationTeams()
   {
      $player_id = request('playerId');
      $invitedTeams = DB::table('player_invitations')->selectRaw('teams.*')
         ->leftJoin('teams', 'player_invitations.team_id', '=', 'teams.id')
         ->where('player_invitations.player_id', $player_id)->get();
      return $invitedTeams;
   }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Team_detail;
use App\Models\Player_Invitation;
use App\Http\Controllers\Controller;
use DB;

class TeamController extends Controller
{
    public function createTeam(Request $request)
    {
        $team = $request->json()->all();
        $player = $team['players'];
        $createdTeam = Team::create([
            'name' => $team['teamName'],
            'leader' => $team['leader'],
            'team_status' => 2,
            'matching_status' => 3,
            'point' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Team_detail::create([
            'team_id' => $createdTeam->id,
            'player_id' => $team['leader'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        foreach($player as $p){
          Player_Invitation::create([
            'team_id' => $createdTeam->id,
            'player_id' => $p,
          ]);
        }

        return response()->json(['success'=> 'team created', 'teamId' => $createdTeam->id]);
    }

    public function recruitTeam(Request $request){
        $team = $request->json()->all();
        $team_id = $team['teamId'];
        $players = $team['players'];
        foreach($players as $player){
          Player_Invitation::create([
            'team_id' => $team_id,
            'player_id' => $player
          ]);
        }

        return response()->json(['success'=> 'member recruited', 'teamId' => $team_id]);
    }

    public function getAllTeam()
    {
        $teams = Team::all();
        return response()->json($teams);
    }

    public function getTeamProfile(Request $request)
    {
        if($request->teamId == null) {
          return response()->json(['error' => 'need teamId']);
        }

        $cTeam = Team::where('id', $request->teamId)->first();


        $team_members = DB::table('team_details')
                            ->selectRaw('players.*')
                            ->leftJoin('players', 'team_details.player_id', '=', 'players.id')
                            ->where('team_details.team_id', $cTeam->id)->get();

            $arr = [];
            foreach ($team_members as $member) {
                $arr[] = $member;
            }

        $team_profile['id'] = $cTeam->id;
        $team_profile['name'] = $cTeam->name;
        $team_profile['logo_url'] = $cTeam->logo_url;
        $team_profile['matching_status'] = $cTeam->matching_status;
        $team_profile['team_status'] = $cTeam->team_status;
        $team_profile['leader'] = $cTeam->leader;
        $team_profile['point'] = $cTeam->point;
        $team_profile['players'] = $team_members;

        return $team_profile;
    }

    public function getChallengeTeam(Request $request)
    {
        if($request->teamId == null) {
          return response()->json(['error' => 'need teamId']);
        }
        $id = $request->teamId;
        $cTeam = Team::where('id', $request->teamId)->first();
        $cPoint = $cTeam->point;

        $teams = Team::where('matching_status', 1)->whereNotIn('id', [$id])->whereBetween('point', [$cPoint-300, $cPoint+300])->get();
        return response()->json($teams);
    }

}

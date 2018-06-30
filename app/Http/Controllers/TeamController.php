<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player_Invitation;
use App\Http\Controllers\Controller;

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
        foreach($player as $p){
          Player_Invitation::create([
            'team_id' => $createdTeam->id,
            'player_id' => $p,
          ]);
        }

        return response()->json(['success'=> 'team created', 'teamId' => $createdTeam->id]);
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
        return response()->json($cTeam);
    }

    public function getChallengeTeam(Request $request)
    {
        if($request->teamId == null) {
          return response()->json(['error' => 'need teamId']);
        }

        $cTeam = Team::where('id', $request->teamId)->first();
        $cPoint = $cTeam->point;

        $teams = Team::where('matching_status', 1)->whereBetween('point', [$cPoint-300, $cPoint+300])->get();
        return response()->json($teams);
    }

}

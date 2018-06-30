<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
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

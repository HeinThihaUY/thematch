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
      $team
    }

    private function getTeamObj() {

    }
}

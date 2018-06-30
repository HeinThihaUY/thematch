<?php

namespace App\Http\Controllers;
use App\Models\Challenge;
use App\Models\Team;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
  public function getChallengeRequest(Request $request)
  {
      $id = $request->teamId;
      $c_team = Challenge::where('accepted_team_id', $id)->where('status','<',3)
                ->select('id','challenger_team_id','status','reserved_time','point')->get();
      return response()->json($c_team);
  }

  public function getChallengedTeam(Request $request)
  {
      $id = $request->teamId;
      $c_team = Challenge::where('challenger_team_id', $id)->get();
      return response()->json($this->getTeam($c_team));
  }

  public function getChanllengeRequestPending(Request $request)
  {
    $id = $request->teamId;
    $c_team = Challenge::where('challenger_team_id', $id)->where('status',1)->get();
    return response()->json($this->getTeam($c_team));
  }

  public function getChanllengeRequestAccepted(Request $request)
  {
      $id = $request->teamId;
      $c_team = Challenge::where('challenger_team_id', $id)->where('status', 2)->get();
      return response()->json($this->getTeam($c_team));
  }

  private function getTeam($c_team)
  {
      $team = array();
      foreach ($c_team as $c) {
        array_push($team, $this->getChallengeObj($c));
      }
      return $team;
  }

  private function getChallengeObj($challenge)
  {
      $c = new \stdClass();
      $c->id = $challenge->id;
      $c->challenger_team_id = $challenge->challenger_team_id;
      $c->challenger_team_name = Team::where('id',$challenge->challenger_team_id)->get()->first()->name;
      $c->accepted_team_id = $challenge->accepted_team_id;
      $c->accepted_team_name = Team::where('id',$challenge->accepted_team_id)->get()->first()->name;
      $c->status = $challenge->status;
      $c->place_id = $challenge->place_id;
      $c->reserved_time = $challenge->reserved_time;
      return $c;
  }

}

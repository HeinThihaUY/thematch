<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('player', 'PlayerController@getPlayer');

Route::get('team', 'TeamController@getTeamProfile');
Route::post('team/create', 'TeamController@createTeam');

Route::get('team/challenge', 'ChallengeController@getChallengedTeam');
Route::get('team/challenge/pending', 'ChallengeController@getChanllengeRequestPending');
Route::get('team/challenge/accept', 'ChallengeController@getChanllengeRequestAccepted');
Route::get('team/challenge/history', 'ChallengeController@getChanllengeRequestFinished');
Route::get('team/challenge/request', 'ChallengeController@getChallengeRequest');

Route::get('challenge/team', 'TeamController@getChallengeTeam');

Route::get('places', 'PlaceController@getPlaces');

Route::get('player/others', 'PlayerController@getAllOtherPlayers');

Route::get('player/recurite', 'PlayerController@getPlayersForRecurite');

Route::get('team/players', 'PlayerController@getTeamPlayers');

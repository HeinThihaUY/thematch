<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('player', 'PlayerController@getPlayer');

Route::get('team', 'TeamController@getTeamProfile');
Route::post('team/create', 'TeamController@createTeam');
Route::post('team/recruit', 'TeamController@recruitTeam');
Route::get('team/players', 'PlayerController@getTeamPlayers');
Route::get('team/challenge', 'ChallengeController@getChallengedTeam');
Route::get('team/challenge/pending', 'ChallengeController@getChanllengeRequestPending');
Route::get('team/challenge/accept', 'ChallengeController@getChanllengeRequestAccepted');
Route::get('team/challenge/history', 'ChallengeController@getChanllengeRequestFinished');
Route::get('team/challenge/request', 'ChallengeController@getChallengeRequest');

Route::get('challenge/team', 'TeamController@getChallengeTeam');
Route::post('challenge/send', 'ChallengeController@createChallenge');

Route::get('team/invite', 'ChallengeController@getInvitedChallenges');
Route::get('team/invite/decline', 'ChallengeController@declineInvitedChallenge');
Route::get('team/invite/accept', 'ChallengeController@acceptInvitedChallenge');

Route::get('places', 'PlaceController@getPlaces');
Route::get('time/check', 'BookingController@checkAvailableTime');

Route::get('player/invite', 'PlayerController@getInvitationTeams');
Route::get('player/invite/accept', 'PlayerController@acceptTeam');
Route::get('player/invite/decline', 'PlayerController@declineTeam');
Route::get('player/others', 'PlayerController@getAllOtherPlayers');
Route::get('player/team', 'PlayerController@getPlayerTeams');
Route::get('player/recruit', 'PlayerController@getPlayersForRecurite');

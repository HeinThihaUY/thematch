<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player_Invitation extends Model
{
  protected $table = 'player_invitations';
  // public $timestamps = false;
  protected $fillable = [
      'team_id', 'player_id'
  ];
}

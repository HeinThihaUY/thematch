<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
  protected $fillable = [
      'challenger_team_id', 'accepted_team_id', 'place_id', 'reserved_time', 'status', 'point', 'created_at', 'updated_at'
  ];
}

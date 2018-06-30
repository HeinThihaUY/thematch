<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  protected $fillable = [
      'name', 'logo_url', 'matching_status', 'team_status', 'leader', 'point', 'created_at', 'updated_at'
  ];

}

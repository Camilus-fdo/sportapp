<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'id', 'name', 'logo',
    ];

    public function teams()
    {
    	return $this->belongstoMany(Team::class, 'tournaments_teams');
    }
}

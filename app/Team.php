<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'id', 'name', 'logo',
    ];

    public function tournaments()
    {
    	return $this->belongstoMany(Tournament::class, 'tournaments_teams');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
use App\Tournament;
use Validator;

class TeamController extends Controller
{

    public function createTeam(Request $request)
    {

    	$validator = Validator::make($request->all(), [
            'name'		=> 'required',
        ]);
    	
    	if(!$validator->fails())
    	{
    		$team_details = $request->all();
    		$filename = $this->saveLogo($request->logo);

    		if(isset($filename)){
    			$team_details['logo'] = $filename;

    			$team = Team::create($team_details);

    			$response = [
	    			'success' => true,
	    			'data'	  => [],
	    			'message' => 'Create team successfully!'
    			];
    			
    			return response()->json($response, 201);
    		}
    	}else{
    		$response = [
    			'success' 	=> true,
    			'errors'	=> $validator->errors(),
    			'message' 	=> 'Create team fail!'
    		];
    			
    		return response()->json($response, 404);
    	}
    }

    public function getAllTeams()
    {
        return Team::all();
    }

    public function getTournamentTeams(Request $request)
    {
        if(isset($request->tournmnt_id)){
            $teams_array = [];
            $tournament = Tournament::find($request->tournmnt_id);
            $teams = $tournament->teams;

            foreach ($teams as $key => $team) {
                array_push($teams_array, $team['name']);
            }
            
            return $teams_array;
        }
    }
}

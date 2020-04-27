<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
use App\Tournament;
use Validator;

class TournamentController extends Controller
{
    public function createTournament(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name'		=> 'required',
        ]);

        if(!$validator->fails())
    	{
    		$tournament_details = $request->all();

    		$filename = $this->saveLogo($request->logo);

    		if(isset($filename)){
    			$tournament_details['logo'] = $filename;

    			$tournament = Tournament::create($tournament_details);

    			$teams = Team::find([1,2,3]);
    			$tournament->teams()->attach($teams);
    			
    			$response = [
	    			'success' => true,
	    			'data'	  => [],
	    			'message' => 'Create tournament successfully!'
    			];
    			
    			return response()->json($response, 201);
    		}
    	}else{
    		$response = [
    			'success' 	=> true,
    			'errors'	=> $validator->errors(),
    			'message' 	=> 'Create tournament fail!'
    		];
    			
    		return response()->json($response, 404);
    	}
    }

    public function sheduleGames(Request $request)
    {
        if(isset($request->id))
        {
            $teams = $this->getTournamentsTeams($request->id);

        }else{
            $response = [
                'success'   => true,
                'errors'    => [],
                'message'   => 'Create tournament fail!'
            ];
                
            return response()->json($response, 404);
        }

    }

    private function getTournamentsTeams($tourmnt_id)
    {
        if(isset($tourmnt_id))
        {
            $teams_array   = [];
            $tournament    = Tournament::find($tourmnt_id);
            $teams         = $tournament->teams;
            // $teams      = Tournament::where('id', '=', $tourmnt_id)->get();

            foreach ($teams as $key => $team) {
                array_push($teams_array, $team['name']);
            
            }
            
            return $teams_array;
        }
    }
}

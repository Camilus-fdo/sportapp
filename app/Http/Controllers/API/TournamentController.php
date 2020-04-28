<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
use App\Tournament;
use App\Game;
use Validator;

class TournamentController extends Controller
{
    public function createTournament(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name'		=> 'required',
            'logo'      => 'required'
        ]);

        if(!$validator->fails())
    	{
    	   	$tournament_details = $request->all();
            $team_names = [];

    		$filename = $this->saveLogo($request->logo);

    		if(isset($filename)){
    			$tournament_details['logo'] = $filename;

    			$tournament = Tournament::create($tournament_details);

    			$teams = Team::find($request->teams);
                
    			$tournament->teams()->attach($teams);
    			
                $genarte_shedule = $this->sheduleGames($tournament['id']);

                if($genarte_shedule == true){
                    $response = [
                        'success' => true,
                        'data'    => $tournament,
                        'message' => 'Create tournament successfully!'
                    ];
                
                return response()->json($response, 201);  
                }
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

    public function sheduleGames($id)
    {
            $teams = $this->getTournamentsTeams($id);

            if (count($teams)%2 != 0){
                array_push($teams,"bye");
            }
            
            $away = array_splice($teams,(count($teams)/2));
            $home = $teams;
            
            for ($i=0; $i < count($home)+count($away)-1; $i++)
            {
                for ($j=0; $j<count($home); $j++)
                {
                    $rounds[$i][$j]["Home"]=$home[$j];
                    $rounds[$i][$j]["Away"]=$away[$j];
                }
                if(count($home)+count($away)-1 > 2)
                {
                    $s = array_splice( $home, 1, 1 );
                    $slice = array_shift( $s  );
                    array_unshift($away,$slice );
                    array_push( $home, array_pop($away ) );
                }
            }
            // var_dump($rounds);

            foreach ($rounds as $key => $games) {
                for($x =0; $x<=2; $x++ ){
                    $games[$x]['tournmnt_id'] = $id;
                } 
                Game::insert($games);   
            }
            
            return true;

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

    public function listTournaments()
    {
        return Tournament::all();
    }
}

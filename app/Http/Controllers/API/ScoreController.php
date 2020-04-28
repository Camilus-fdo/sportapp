<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Score;

class ScoreController extends Controller
{
    public function saveScore(Request $request)
    {
    		    
            $scores = $request->all();
    		Score::insert($scores);

            $status = DB::table('games')
            ->where('id', $request->team1_object['game_id'])
            ->update(['status' => 1]);

            if($status == 1){
                $response = [
                    'success' => true,
                ];
                
                return response()->json($response, 200); 
            }
            
    }

    public function getLeaderBoard(Request $request)
    {
    	
    	$teams = $request->teams;
    	$teams_array = [];
    	$dups = [];

    	foreach ($teams as $key => $team) {

    		$team_result = DB::table('scores')
		                    ->where([
                                ['team_name', '=', $team],
                                ['tournmnt_id', '=', $request->tournmnt_id]
                            ])
		                    ->pluck('team_name');
            
            $teams_array[$key]['team'] 		= $team;
            $teams_array[$key]['team_wins']	= count($team_result);
           
    	}
    	$wins  = array_column($teams_array, 'team_wins');
		$teams = array_column($teams_array, 'team');
    	array_multisort($wins, SORT_DESC, $teams, SORT_ASC, $teams_array);
		
		$response = [
                'success' => true,
                'data'    => $teams_array,
            ];
                
        return response()->json($response, 200);
		// foreach(array_count_values($wins) as $val => $c){
	 //    	if($c > 1) $dups[] = $val;
		// }

		// $dup_team = $this->search_exif($teams_array, $dups[0]);
		// return $teams_array;
    }

 //    function search_exif($exif, $field)
	// {
	// 	$dup_teams = [];
	//     foreach ($exif as $data)
	//     {
	//         if ($data['team_wins'] == $field)
	//             array_push($dup_teams, $data['team']);
	//             return $dup_teams;
	//     }
	// }
}

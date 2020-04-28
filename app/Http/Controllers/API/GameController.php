<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function getFixture(Request $request)
    {
    	if(isset($request->id)){
    		$fixture = DB::table('games')->where('tournmnt_id', $request->id)->get();
    		return $fixture;
    	}
    }
}

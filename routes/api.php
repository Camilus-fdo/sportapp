<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

# Route::middleware('auth:api')->get('/user', function (Request $request) {
#     return $request->user();
# });

Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');

Route::post('create_team', 'API\TeamController@createTeam');
Route::post('create_tournament', 'API\TournamentController@createTournament');
Route::post('shedule_games', 'API\TournamentController@sheduleGames');
Route::get('all_teams', 'API\TeamController@getAllTeams');

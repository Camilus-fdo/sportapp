<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
            'c_password'=> 'required|same:password',
        ]);
        
        if(!$validator->fails())
        {
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            $success['token'] = $user->createToken('MyApp')->accessToken;
            
            $response = [
                'success' => true,
                'message' => 'successful!',
                'data'    => ['token' => $success['token']]
            ];

            return response()->json($response, 201);
        }else{
            
            $response = [
                'success' => false,
                'data'    => 'Validation Error',
                'message' => $validator->errors()
            ];

            return response()->json($response, 404);
        }

    }


    public function login(Request $request) 
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = $request->only('email', 'password');
        if(!$validator->fails())
        {
        	if(Auth::attempt($data))
            {
    			$user         = Auth::user();
    			$success['token'] = $user->createToken('MyApp')->accessToken;
    			$response = [
    				'success' => true,
    				'message' => 'Login successful',
    				'data'    => ['token' => $success['token']]   
    			];

    			return response()->json($response, 200);
            }else{
    			$response = [
    				'success' => false,
    				'message' => 'Login fial',
    				'errors'  =>'Unauthorized'    
    			];
    			return response()->json($response, 404);
            }
        }else{
            $response = [
                'success' => false,
                'errors'    => $validator->errors(),
                'message' => 'Validation Error'
            ];
            return response()->json($response, 404);
        }
    }

}

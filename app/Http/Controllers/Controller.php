<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function saveLogo($logo)
    {
    	if(isset($logo)){
    		$exp1   = explode(',', $logo);
	        $decode = base64_decode($exp1[1]);
	            
	        if(strpos($exp1[0], 'png')){
	            $exte = 'png';
	        }else{
	            $exte = 'jpg';
	        }

	        $current_time   = Carbon::now()->timestamp;
	        $filename       = $current_time.'.'.$exte;
	        $file_path      = public_path().'/images/logo/'.$filename;

	        file_put_contents($file_path, $decode);

	        return $filename;
    	}
    	

    }
}

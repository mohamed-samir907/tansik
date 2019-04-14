<?php

namespace App\Http\Controllers;

use App\Model\Student;
use App\MyHelper;

use Illuminate\Http\Request;

class TestController extends Controller
{
	/**
	 * Display the result page
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('search');
	}

    /**
     * Get the result for the selected student number
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function result(Request $request) 
    {
    	$s_number 	= MyHelper::sanitizeInteger($request->s_number);
    	$data 		= Student::where('s_number', $s_number)->with('school')->first();
        
    	return response($data);
    }
}

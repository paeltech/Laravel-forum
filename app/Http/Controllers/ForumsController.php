<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Discussion;

class ForumsController extends Controller
{
    public function index() 
    {
    	$discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);
    	return view('forum', ['discussions'=> $discussions]);
    }
}

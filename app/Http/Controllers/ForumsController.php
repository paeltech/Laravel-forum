<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Discussion;
use App\Channel;

class ForumsController extends Controller
{
    public function index() 
    {
    	$discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);
    	return view('forum', ['discussions'=> $discussions]);
    }

    public function show($slug)
    {
    	$channel = Channel::where('slug', $slug)->first();
        return view('channels.channel')->with('discussions', $channel->discussions);
    }
}

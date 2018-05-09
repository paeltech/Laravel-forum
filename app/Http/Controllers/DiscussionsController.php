<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Discussion;
use App\Reply;
use Auth;
use Session;

class DiscussionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discuss');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $r = request();
        $this->validate($r, [
            'channel_id' => 'required',
            'content' => 'required',
            'title' => 'required'
        ]);

        $discussion = Discussion::create([
            'title' => $r->title,
            'channel_id' => $r->channel_id,
            'content' => $r->content,
            'user_id' => Auth::id(),
            'slug' => str_slug($r->title)
        ]);

        Session::flash('success', 'Discussion created');

        return redirect()->route('discussion', ['slug'=> $discussion->slug]);

    }

    public function reply($id)
    {
        $d = Discussion::find($id);
        $r = request();
        // $this->validate($r, [
        //     'channel_id' => 'required',
        //     'content' => 'required',
        //     'title' => 'required'
        // ]);

        $reply = Reply::create([
            'discussion_id' => $id,
            'content' => $r->reply,
            'user_id' => Auth::id()
        ]);

        Session::flash('success', 'Replied to a discussion');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        return View('discussions.show')->with('discussion', Discussion::where('slug', $slug)->first());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('channels.edit')->with('channel', Channel::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $channel = Channel::find($id);
        $channel->title = $request->channel;
        $channel->save();

        Session::flash('Success', 'Channel edited succesfully');

        return redirect()->route('channels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Channel::destroy($id);

        Session::flash('Success', 'Channel deleted succesfully');

        return redirect()->route('channels.index');
    } 
}

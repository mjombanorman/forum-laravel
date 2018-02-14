<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Reply;
use Auth;
use Session;

class DiscussionsController extends Controller {

    
    public function create() {
        return view('discussion.create');
    }

    public function store(REQUEST $request) {

        $this->validate($request, [
            'channel_id' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);
        $discussion = Discussion::create([
                    'title' => $request->title,
                    'channel_id' => $request->channel_id,
                    'content' => $request->content,
                    'user_id' => Auth::id(),
                    'slug' => str_slug($request->title)
        ]);

        Session::flash('success', 'Successfully Created a discussion.');
        return redirect()->route('discussion.show', ['slug' => $discussion->slug]);
    }

    public function show($slug) {
        $discussion = Discussion::where('slug', $slug)->first();

       return view('discussion.show', ['d' => $discussion]);
    }
    public function reply($id) {
        $d = Discussion::find($id);
        $reply = Reply::create([
            'user_id'=>Auth::id(),
            'discussion_id'=>$id,
            'content'=>request()->reply
        ]);
        
        Session::flash('success','Replied to discussion');
        return redirect()->back();
    }

}

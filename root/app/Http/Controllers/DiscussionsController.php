<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Reply;
use App\User;
use App\UserPoints;
use Auth;
use Session;
use App\Notifications\NewReply;
use Notification;

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

        $best_answer = $discussion->replies()->where('best_answer', 1)->first();

        return view('discussion.show', [
            'd' => $discussion,
            'best_answer' => $best_answer
        ]);
    }

    public function reply($id) {

        $d = Discussion::find($id);

        $reply = Reply::create([
                    'user_id' => Auth::id(),
                    'discussion_id' => $id,
                    'content' => request()->reply
        ]);

        $points = UserPoints::where('user_id', Auth::id())->first();
       // dd($points);
        if (empty($points)) {
            UserPoints::create([
                'user_id' => Auth::id(),
                'points' => 15
            ]);
        } else if(!empty ($points)) {
            $points->points += 5;
            $points->save();
        }



        $watchers = array();

        foreach ($d->watchers as $watcher):

            array_push($watchers, User::find($watcher->user_id));

        endforeach;

        Notification::send($watchers, new NewReply($d));

        Session::flash('success', 'Replied to discussion');
        return redirect()->back();
    }

    
    public function edit($slug) {
        
        return view('discussion.edit',[
            'discussion'=> Discussion::where('slug',$slug)->first()
        ]);
        
    }
    
    
    public function update($id) {
        
        $this->validate(request(),[
            'content'=>'required'
        ] );
        
        $d = Discussion::find($id);
        
        $d->content = request()->content; 
        
        $d->save();
        Session::flash('success','Discussion Updated');
        
        return redirect()->route('discussion.show',['slug'=>$d->slug]);
        
    }
}

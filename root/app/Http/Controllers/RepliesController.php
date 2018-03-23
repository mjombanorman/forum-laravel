<?php

namespace App\Http\Controllers;
use App\Reply;
use App\Like;
use Session;
use Auth;
use Illuminate\Http\Request;
use App\UserPoints;

class RepliesController extends Controller
{
    
    public function like($id) {
        
        
        Like::create([
            'reply_id'=>$id,
            'user_id'=> Auth::id()
                    ]);
        
        Session::flash('success','Liked');
        return redirect()->back();
    }
    
    
    public function unlike($id) {
        $like = Like::where('reply_id',$id)->where('user_id',Auth::id())->first();
        $like->delete();
        Session::flash('success','unliked');
        return redirect()->back();
    }
    
    public function best_answer($id) {
        
        $reply = Reply::find($id);
        $reply->best_answer = 1;
                $reply->save();
                
                
                 $points = UserPoints::where('user_id', Auth::id())->first();
    
            $points->points += 15;
            $points->save();
        

         Session::flash('success','marked');
        return redirect()->back();
    }
    
    
     public function edit($id) {
        
        return view('replies.edit',[
            'reply'=> Reply::find($id)
        ]);
        
    }
    
    
    public function update($id) {
        
        $this->validate(request(),[
            'content'=>'required'
        ] );
        
        $reply = Reply::find($id);
        
        $reply->content = request()->content; 
        
        $reply->save();
        Session::flash('success','Reply Updated');
        
        return redirect()->route('discussion.show',['slug'=>$reply->discussion->slug]);
        
    }
}

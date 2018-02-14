<?php

namespace App\Http\Controllers;
use App\Reply;
use App\Like;
use Session;
use Auth;
use Illuminate\Http\Request;

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
    
}

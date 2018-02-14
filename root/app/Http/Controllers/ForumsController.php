<?php

namespace App\Http\Controllers;
use App\Discussion;
use Illuminate\Http\Request;
use App\Channel;

class ForumsController extends Controller
{
    public function index() {
        
        $discussions = Discussion::orderBy('created_at','desc')->paginate(2);
        
        return view('forum',
                ['discussions'=>$discussions]);
        
    }
    
    public function channel($id) {
        $channel = Channel::find($id);
        
        return view('channel',[
            'discussions'=>$channel->discussions
        ]); 
    }
    
    
}

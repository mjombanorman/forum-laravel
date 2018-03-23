<?php

namespace App\Http\Controllers;

use App\Discussion;
use Illuminate\Http\Request;
use App\Channel;
use Auth;
use Illuminate\Pagination\Paginator;
class ForumsController extends Controller {

    public function index() {

        ///   $discussions = Discussion::orderBy('created_at','desc')->paginate(2);

        switch (request('filter')):
            
            case 'me':
                $results = Discussion::where('user_id', Auth::id())->orderBy('created_at','desc')->paginate(2);
                break;
                case 'answered':
                    $answered = array();
                    foreach (Discussion::all() as $discussion){
                        if($discussion->hasBestAnswer()){
                            array_push($answered, $discussion);
                        }
                    }
                    
                    $results = new Paginator($answered, 2);
                    break;
             case 'unanswered':
                    $unanswered = array();
                    foreach (Discussion::all() as $discussion){
                        if(!$discussion->hasBestAnswer()){
                            array_push($unanswered, $discussion);
                        }
                    }
                    
                    $results = new Paginator($unanswered, 2);
                    break;
            default:
             $results = Discussion::orderBy('created_at','desc')->paginate(2);
                break;
            
        endswitch;

        return view('forum', ['discussions' => $results]);
    }

    public function channel($slug) {
        $channel = Channel::where('slug', $slug)->first();

        return view('channel', [
            'discussions' => $channel->discussions
        ]);
    }

}

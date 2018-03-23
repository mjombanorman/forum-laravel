@extends('layouts.app')

@section('content')
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{asset($d->user->avatar)}}" alt="" width="40px" height="40px">&nbsp;&nbsp;
            <span>{{$d->user->name}},<b>{{$d->created_at->diffForHumans()}}</b></span>
            
             @if($d->hasBestAnswer())
                    <span class="btn btn-danger btn-xs pull-right">closed</span>
                    @else
                       <span class="btn btn-success btn-xs pull-right">open</span>
                       @endif
                       
            @if(Auth::id() == $d->user->id)
            @if(!$d->hasBestAnswer())
             <a href="{{route('discussion.edit',['slug'=>$d->slug])}}"class="btn btn-xs btn-default pull-right">Edit</a>
             @endif
             @endif
             
            @if(Auth::check())
            @if($d->is_watched_by_user())
             <a href="{{route('discussion.unwatch',['id'=>$d->id])}}"class="btn btn-xs btn-default pull-right">Unwatch</a>
             @else
               <a href="{{route('discussion.watch',['id'=>$d->id])}}"class="btn btn-xs btn-default pull-right">Watch</a>
             @endif
             @endif
        </div>

        <div class="panel-body">
            <h4 class="text-center">{{$d->title}}</h4>
            <p>
                {!! Markdown::convertToHtml($d->content)!!}
            </p>

        </div>
        <div class="panel-footer">
            <p>
                {{$d->replies->count()}} replies
            </p>
        </div>
    </div>
</div>
<div class="row">
    @if($d->replies->count()< 0)
    <div class="panel panel-default">
        <div class="panel-body">
            <h5>No replies for this discussion</h5>
        </div>
    </div>
    @else
        @if($best_answer)
            <div class="panel panel-warning">
    <div class="panel-heading">
        <h4 class="text-center">Best Answer</h4>
        <img src="{{asset($best_answer->user->avatar)}}" alt="" width="40px" height="40px">&nbsp;&nbsp;
        <span>{{$best_answer->user->name}}<b>{{$best_answer->created_at->diffForHumans()}}</b></span>
    </div>

    <div class="panel-body">
        <p>
            {!! Markdown::convertToHtml($best_answer->content)!!}
          
       </p>
    </div>
   
    
</div>
          @endif
    @foreach($d->replies as $r)
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{asset($r->user->avatar)}}" alt="" width="40px" height="40px">&nbsp;&nbsp;
            <span>{{$r->user->name}},<b>{{$r->created_at->diffForHumans()}}</b></span>
            
            
            
          @if(!$best_answer)
          @if(Auth::id()== $d->user->id)
          <a href="{{route('reply.best.answer',['id'=>$r->id])}}" class="btn btn-xs btn-default">Mark as best answer</a>
          @endif
          @endif
        </div>

        <div class="panel-body">

            <p>
                {!! Markdown::convertToHtml($r->content)!!}
               
            </p>

        </div>
        <div class="panel-footer">
            <p>
                @if($r->liked_auth_user())
                
                <a href="{{route('reply.unlike',['id'=>$r->id])}}" class="btn btn-warning btn-xs">unlike<span class="badge">{{$r->likes->count()}}</span></a>
                @else
    <a href="{{route('reply.like',['id'=>$r->id])}}" class="btn btn-primary btn-xs">Like <span class="badge">{{$r->likes->count()}}</span></a>
                @endif
                <span class="badge"></span>
                
                  @if(Auth::id()== $r->user->id)
                  @if(!$r->discussion->hasBestAnswer())
          <a href="{{route('reply.edit',['id'=>$r->id])}}" class="btn btn-xs btn-default">Edit Reply</a>
          @endif
          @endif
            </p>
        </div>
    </div>
    @endforeach
    
  
    @endif
</div> 
@if(Auth::check())
<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <form  action="{{route('discussion.reply',['id'=>$d->id])}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Leave a Reply:</label>
                    <textarea name="reply" id="reply" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        Leave a reply
                    </button>
            </form>
        </div>
    </div>
</div>
</div>
@else
<div class="text-center">Login to Comment</div>
@endif

@endsection

@section('styles')
 <link href="{{ asset('assets/highlight/monokai-sublime.css') }}" rel="stylesheet">
@endsection
@section('scripts')
<script src="{{ asset('assets/highlight/highlight.pack.js') }}"></script>
<script>hljs.initHighlightingOnLoad();</script>
@endsection
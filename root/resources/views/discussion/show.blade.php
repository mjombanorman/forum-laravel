@extends('layouts.app')

@section('content')
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{asset($d->user->avatar)}}" alt="" width="40px" height="40px">&nbsp;&nbsp;
            <span>{{$d->user->name}},<b>{{$d->created_at->diffForHumans()}}</b></span>
             <a href="{{route('discussion.show',['slug'=>$d->slug])}}"class="btn btn-default pull-right">Watch</a>
        </div>

        <div class="panel-body">
            <h4 class="text-center">{{$d->title}}</h4>
            <p>
                {{$d->content}}
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
    @foreach($d->replies as $r)
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{asset($r->user->avatar)}}" alt="" width="40px" height="40px">&nbsp;&nbsp;
            <span>{{$r->user->name}},<b>{{$r->created_at->diffForHumans()}}</b></span>
        </div>

        <div class="panel-body">

            <p>
                {{$r->content}}
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

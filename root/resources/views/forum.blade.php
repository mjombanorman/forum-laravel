@extends('layouts.app')

@section('content')
    @foreach($discussions as $d)
              <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="{{$d->user->avatar}}" alt="" width="40px" height="40px">&nbsp;&nbsp;
                    <span>{{$d->user->name}},<b>{{$d->created_at->diffForHumans()}}</b></span>
                    <a href="{{route('discussion.show',['slug'=>$d->slug])}}"class="btn btn-default btn-xs pull-right"> view</a>
                    
                    @if($d->hasBestAnswer())
                    <span class="btn btn-danger btn-xs pull-right">closed</span>
                    @else
                       <span class="btn btn-success btn-xs pull-right">open</span>
                       @endif
                    
                </div>

                <div class="panel-body">
                    <h4 class="text-center">{{$d->title}}</h4>
                    <p>
                         {{str_limit($d->content,150)}}
                    </p>
                 
                </div>
                  <div class="panel-footer">
                      <span>
                          {{$d->replies->count()}} replies
                      </span>
                      <a href="{{route('channel',['slug'=>$d->channel->id])}}"class="btn-xs pull-right btn btn-default">{{ $d->channel->title}}</a>
                  </div>
                  </div>
                  @endforeach
    
    <div class="row">
        <span class="col-md-offset-5">
        {{$discussions->links()}}
        </span>
    </div>

@endsection

<?php

/* 
 * This Code was generated by Mjomba Norman.
 * The code is not limited to correction but to open to public for educational use.
 * Scruitiny and corrections are openly allowed.
 * Project intended for Open Source use.
 *  twitter: @MjombaCertfied github:mjombanorman bitbucket:mjombanorman
 */
?>
@extends('layouts.app')

@section('content')
    @foreach($discussions as $d)
              <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="{{$d->user->avatar}}" alt="" width="40px" height="40px">&nbsp;&nbsp;
                    <span>{{$d->user->name}},<b>{{$d->created_at->diffForHumans()}}</b></span>
                    <a href="{{route('discussion.show',['slug'=>$d->slug])}}"class="btn btn-default pull-right">view</a>
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
       
    </div>

@endsection

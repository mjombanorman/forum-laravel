@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Channel:{{$channel->title}}</div>

                <div class="panel-body">
                   <form action="{{route('channels.update',['id'=>$channel->id])}}" method="post">
                       {{csrf_field()}}
                       {{method_field('PUT')}}
                       <div class="form-group">
                           <input class="form-control" name="channel" value="{{$channel->title}}" type="text">
                       </div>

                       <div class="form-group">
                        <button class="btn-success" type="submit">
                            Update Channel
                        </button>
                            
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

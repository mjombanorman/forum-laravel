@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading text-center">Create a New Discussion</div>
    <div class="panel-body">

        <form action="{{route('discussion.store')}}" method="post">
            {{csrf_field()}}

            <div class="form-group"><label for="title">Title</label>
                <input type="text" name="title" value="{{old('title')}}"class="form-control">
            </div>

            <div class="form-group">
                <label for="channel">Pick up  a channel</label>
                <select name="channel_id" id="channel_id" class="form-control">
                    @foreach($channels as $channel)
                    <option value="{{$channel->id}}">{{$channel->title}}</option>
                    @endforeach
                </select>
            </div>
    
    <div class="form-group">
        <label for="content">Ask a question</label>
        <textarea name="content" id="content" cols="28" class="form-control" rows="10">{{old('name')}}</textarea>
    </div>

    <div class="form-group">
        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-send"></i>Create a Discusion</button>
    </div>

</form>
</div>
</div>
@endsection

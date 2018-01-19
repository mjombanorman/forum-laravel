@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   <table class="table table-hover">
                   <thead>
                   <th>Name</th>
                   <th>Edit</th>
                   <th>Delete</th>
                   </thead>
                   <tbody>
                   <tr>
                   @foreach($channels as $channel)
                   <td>{{$channel->name}}</td>
                   <td><a href="{{route('channel.edit',['channel'=>$channel->id])}}" class="btn btn-xs btn-primary">Edit</a></td>
                   <td><a href="{{route('channel.destroy',['channel'=>$channel->id])}}" class="btn btn-xs btn-delete">Delete</a></td>
                   </tr>
                   @endforeach
                   </tbody>
                   
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

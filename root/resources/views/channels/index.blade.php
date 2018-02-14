@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Channels</div>

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
                   <td>{{$channel->title}}</td>
                   <td><a href="{{route('channels.edit',['channel'=>$channel->id])}}" class="btn btn-xs btn-primary">Edit</a></td>
                   <td>
                   <form action="{{route('channels.destroy',['id'=>$channel->id])}}" method="post">
                   
                   {{csrf_field()}}
                   {{method_field('DELETE')}}
                   <button type="submit" class="btn btn-xs btn-danger">
                   Delete Channel</button> 
                   
                   </form>
                   </td>
                   
                   
                   
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

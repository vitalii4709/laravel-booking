@extends('layouts.backend') 

@section('content') 
<h2>List of objects</h2>
@foreach( $objects as $object ) 

    <div class="col-md-8  panel panel-success top-buffer" style="width: 60vw;">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $object->name  }} object <small><a href="{{ route('saveObject',['id'=>$object->id])  }}" class="btn btn-danger btn-xs">edit</a> <a href="{{ route('saveRoom').'?object_id='.$object->id  }}" class="btn btn-danger btn-xs">add a room</a> <a class="btn btn-danger btn-xs" title="delete" href="{{ route('deleteObject',['id'=>$object->id]) }}">delete object</a></small> </h3>
        </div>

        <div class="panel-body">
            @foreach( $object->rooms as $room ) 
                <span class="my_objects">
                    Room {{ $room->room_number  }} <a title="edit" href="{{ route('saveRoom',['id'=>$room->id]) }}"><span class="glyphicon glyphicon-edit"></span></a> <a title="delete" href="{{ route('deleteRoom',['id'=>$room->id])  }}"><span class="glyphicon glyphicon-remove"></span></a> </span>
            @endforeach 
        </div>

    </div>

@endforeach 

@endsection 
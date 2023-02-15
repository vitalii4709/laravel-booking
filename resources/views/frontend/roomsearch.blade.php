@extends('layouts.frontend') 

@section('content') 
<div class="container-fluid places">

    <h1 class="text-center">Available rooms</h1>

    @foreach( $city->rooms->chunk(3) as $chunked_rooms ) 

        <div class="row">

            @foreach( $chunked_rooms as $room ) 

                <div class="col-md-4 col-sm-6">

                    <div class="thumbnail">
                        <img class="img-responsive img-circle" src="{{ $room->photos->first()->path ?? $placeholder  }}" alt="...">
                        <div class="caption">
                            <h3>Nr {{ $room->room_number  }} <small class="orange bolded">{{ $room->price  }}$</small> </h3>
                            <p>{{ substr($room->description,0,80)  }}</p>
                            <p><a href="{{ route('room',['id'=>$room->id]) }}" class="btn btn-primary" role="button">Details</a><a href="{{ route('room',['id'=>$room->id]) }}#reservation" class="btn btn-success pull-right" role="button">Reservation</a></p>
                        </div>
                    </div>
                </div>

            @endforeach 


        </div>

    @endforeach 

</div>
@endsection 
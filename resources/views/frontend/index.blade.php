@extends('layouts.frontend') 

@section('content')
<div class="container-fluid places">
    
    
    @if (session('norooms'))
    <p class="text-center red bolded">
        {{ session('norooms') }}
    </p>
    @endif

    <h1 class="text-center">Interesting places</h1>

    @foreach($objects->chunk(4) as $chunked_object) 

        <div class="row">

            @foreach($chunked_object as $object) 

                <div class="col-md-3 col-sm-6">

                    <div class="thumbnail">
                        <img class="img-responsive" src="{{ $object->photos->first()->path ?? Vite::image('placeholder.jpg') }}" alt="...">
                        <div class="caption">
                            <h3>{{ $object->name }}  <small>{{ $object->city->name  }}</small> </h3>
                            <p>{{ substr($object->description,0,200) }}</p>
                            <p><a href="{{ route('object',['id'=>$object->id]) }}" class="btn btn-primary" role="button">Details</a></p>
                        </div>
                    </div>
                </div>

            @endforeach 


        </div>

    @endforeach 
    
    {{ $objects->links() }} 

</div>
@endsection
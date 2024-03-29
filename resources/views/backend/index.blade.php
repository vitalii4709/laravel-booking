@extends('layouts.backend') 

@section('content') 
<h2 class="sub-header">Booking calendar</h2>

@foreach( $objects as $o=>$object ) 

@php ( $o++ ) 
    <h3 class="red">{{ $object->name }} object</h3>


    @foreach( $object->rooms as $r=>$room ) 
    
    @push('scripts')
    <script>

    function datesBetween(startDt, endDt) {
        var between = [];
        var currentDate = new Date(startDt);
        var end = new Date(endDt);
        while (currentDate <= end) {
            between.push( $.datepicker.formatDate('mm/dd/yy',new Date(currentDate)) );
            currentDate.setDate(currentDate.getDate() + 1);
        }

        return between;
    }

    var eventDates{{ $o.$r }} = {}; 
    var datesConfirmed{{ $o.$r }} = []; 
    var datesnotConfirmed{{ $o.$r }} = [];
    
    @foreach($room->reservations as $reservation)

        @if ($reservation->status)
                datesConfirmed{{$o.$r}}.push(datesBetween(new Date('{{$reservation->day_in}}'), new Date('{{$reservation->day_out}}')));
        @else
                datesnotConfirmed{{$o.$r}}.push(datesBetween(new Date('{{$reservation->day_in}}'), new Date('{{$reservation->day_out}}')));
        @endif

    @endforeach
    
    datesConfirmed{{$o.$r}} = [].concat.apply([], datesConfirmed{{$o.$r}}); 
    datesnotConfirmed{{$o.$r}} = [].concat.apply([], datesnotConfirmed{{$o.$r}}); 


    for (var i = 0; i < datesConfirmed{{ $o.$r }}.length; i++) 
    {
        eventDates{{ $o.$r }}[ datesConfirmed{{ $o.$r }}[i] ] = 'confirmed'; 
    }

    var tmp{{ $o.$r }} = {}; 
    for (var i = 0; i < datesnotConfirmed{{ $o.$r }}.length; i++) 
    {
        tmp{{ $o.$r }}[ datesnotConfirmed{{ $o.$r }}[i] ] = 'notconfirmed'; 
    }


    Object.assign(eventDates{{ $o.$r }}, tmp{{ $o.$r }});  


    $(function () {
        $(".reservation_calendar" + {{ $o.$r }}.datepicker({
            onSelect: function (date) {

                $('.hidden_' + {{ $o.$r }}).hide(); 
                $('.loader_' + {{ $o.$r }}).show(); 
                
                App.GetReservationData({{ $room->id }}, {{ $o.$r }}, date );

            },
            beforeShowDay: function (date)
            {
                var tmp = eventDates{{ $o.$r }}[ $.datepicker.formatDate('mm/dd/yy', date)]; 
                console.log(tmp);
                if (tmp)
                {
                    if (tmp == 'confirmed')
                        return [true, 'reservationconfirmed'];
                    else
                        return [true, 'reservationnotconfirmed'];
                } else
                    return [false, ''];

            }


        });
    });


    </script>
    @endpush

        <h4 class="blue"> Room {{ $room->room_number  }}</h4>
        
        <div class="row top-buffer" >
            
            <div class="col-md-3 col-md-pull-2" >
                <div class="reservation_calendar{{ $o.$r}} " ></div>
            </div>
            <div class="col-md-9 ">
                <div class="center-block loader loader_{{ $o.$r}}" style="display: none;"></div>
                <div class="hidden_{{ $o.$r }}" style="display: none;">


                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Room number</th>
                                    <th>Check in</th>
                                    <th>Check out</th>
                                    <th>Guest</th>
                                    
                                    @if( Auth::user()->hasRole(['admin','owner']) )
                                    <th>Confirmation</th>
                                    @endif
                                    
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="reservation_data_room_number"></td> 
                                    <td class="reservation_data_day_in"></td> 
                                    <td class="reservation_data_day_out"></td> 
                                    <td><a class="reservation_data_person" target="_blank" href=""></a></td> 
                                    <!-- Lecture 29 -->
                                    @if( Auth::user()->hasRole(['admin','owner']) )
                                    <td><a href="#" class="btn btn-primary btn-xs reservation_data_confirm_reservation">Confirm</a></td> 
                                    @endif
                                    
                                    <td><a class="reservation_data_delete_reservation" href=""><span class="glyphicon glyphicon-remove"></span></a></td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>

        <hr>

    @endforeach 

@endforeach 
@endsection 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enjoythetrip\Gateways\FrontendGateway; 
use App\Enjoythetrip\Interfaces\FrontendRepositoryInterface;
use App\Events\OrderPlacedEvent; 

class FrontendController extends Controller
{
    public function __construct(FrontendRepositoryInterface $frontendRepository, FrontendGateway $frontendGateway) /* FrontendRepositoryInterface */
    {
        $this->middleware('auth')->only(['makeReservation','addComment','like','unlike']); 
        
        $this->fR = $frontendRepository;
        $this->fG = $frontendGateway; 
    }
    
    public function index()
    {
        $objects = $this->fR->getObjectsForMainPage(); 
	//dd($objects); 
        return view('frontend.index',['objects'=>$objects]); /* second argument */
    }
    
    public function article($id)
    {
        $article = $this->fR->getArticle($id);
        return view('frontend.article',compact('article')); 
    }
    
    public function object($id=null) 
    {
        $object = $this->fR->getObject($id); 
        
        //dd($object); 
        
        return view('frontend.object',['object'=>$object]); /* second argument */
    }
    
    public function person($id)
    {
        $user = $this->fR->getPerson($id); 
        return view('frontend.person', ['user'=>$user]);
    }
    
    public function room($id) 
    {
        $room = $this->fR->getRoom($id);
        //dd($room->id);
        return view('frontend.room',['room'=>$room]);
    }
    
    public function ajaxGetRoomReservations($id)
    {
        
        $reservations = $this->fR->getReservationsByRoomId($id);
        
        return response()->json([
            'reservations'=>$reservations
        ]);
    }
    
    public function roomsearch(Request $request)
    {
        if($city = $this->fG->getSearchResults($request))
        {
            //dd($city);
            return view('frontend.roomsearch',['city'=>$city]);
        }
        else 
        {
            if (!$request->ajax())
            return redirect('/')->with('norooms', __('No offers were found matching the criteria'));
        }
        
    }
    
    public function searchCities(Request $request)
    {

        $results = $this->fG->searchCities($request);

        return response()->json($results);
    }
    
    
    /*public function like($likeable_id, $type, Request $request)
    {
        $this->fR->like($likeable_id, $type, $request);

        return back();
    }*/
    
    
    
    /*public function unlike($likeable_id, $type, Request $request)
    {   
        $this->fR->unlike($likeable_id, $type, $request);
        
        return back();
    }*/
    
    
    /*public function addComment($commentable_id, $type='App\Models\TouristObject', Request $request)
    {
        $this->fG->addComment($commentable_id, $type, $request);
        
        return back();
    }*/
    
    public function makeReservation($room_id, $city_id, Request $request)
    {
        
        $avaiable = $this->fG->checkAvaiableReservations($room_id, $request);
        
        if(!$avaiable)
        {
            if (!$request->ajax())
            {
                $request->session()->flash('reservationMsg', __('There are no vacancies'));
                return redirect()->route('room',['id'=>$room_id,'#reservation']); 
            }
            
            return response()->json(['reservation'=>false]);
        }
        else
        {     
            $reservation = $this->fG->makeReservation($room_id, $city_id, $request);
            
            event( new OrderPlacedEvent($reservation) ); 
            
            if (!$request->ajax())
            return redirect()->route('adminHome'); 
            else
            return response()->json(['reservation'=>$reservation]);
        }
 
    }
  
}

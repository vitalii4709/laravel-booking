<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\CityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[FrontendController::class, 'index'])->name('home'); 
Route::get(trans('routes.object').'/{id}',[FrontendController::class, 'object'])->name('object'); /* 15 /{id}  */
Route::post(trans('routes.roomsearch'),[FrontendController::class, 'roomsearch'])->name('roomSearch'); /* 18 get->post */
Route::get(trans('routes.room').'/{id}',[FrontendController::class, 'room'])->name('room'); /* 19 {id} */
Route::get(trans('routes.article').'/{id}',[FrontendController::class, 'article'])->name('article'); 
Route::get(trans('routes.person').'/{id}',[FrontendController::class, 'person'])->name('person'); 

Route::get('/searchCities', [FrontendController::class, 'searchCities']); 
Route::get('/ajaxGetRoomReservations/{id}', [FrontendController::class, 'ajaxGetRoomReservations']); 

//Route::get('/like/{likeable_id?}/{type}', [FrontendController::class, 'like'])->name('like'); 
//Route::get('/unlike/{likeable_id?}/{type}', [FrontendController::class, 'unlike'])->name('unlike');

Route::get('like', function(Request $request){
    
    $likeable_type = $request->input('likeable_type');
        
    $likeable = $likeable_type::find($request->input('likeable_id'));
    
     $likeable->users()->attach($request->user()->id, ['likeable_id'=>$request->input('likeable_id'),'likeable_type'=>$request->input('likeable_type')]);
    
    return back();

})->name('like');

Route::get('unlike', function(Request $request){

    $likeable_type = $request->input('likeable_type');
          
    $likeable = $likeable_type::find($request->input('likeable_id'));
      
     $likeable->users()->detach($request->user()->id);

    return back();
    
})->name('unlike');

Route::post('addComment', function(Request $request){
    // Create a new instance of the Post model
    $comment = new App\Models\Comment;
    // Assign values to model’s attributes
    $comment->content = $request->input('content');
    $comment->commentable_id = $request->input('commentable_id');
    $comment->commentable_type = $request->input('commentable_type');
    $comment->rating = $request->input('rating');
    // Assign values to model’s attribute user's ID
    $comment->user_id = $request->user()->id;
    // Insert the record in the DB
    $comment->save();
    // Display the new record containing the comment
    return back();
})->name('addComment');

Route::post('/makeReservation/{room_id}/{city_id}', [FrontendController::class, 'makeReservation'])->name('makeReservation'); 


Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){    
  
  //for json mobile
  Route::get('/getNotifications', [BackendController::class, 'getNotifications']); 
  Route::post('/setReadNotifications', [BackendController::class, 'setReadNotifications']); 
  
  Route::get('/',[BackendController::class, 'index'])->name('adminHome');   
  Route::get(trans('routes.myobjects'),[BackendController::class, 'myobjects'])->name('myObjects');   
  Route::match(['GET','POST'],trans('routes.saveobject').'/{id?}',[BackendController::class, 'saveObject'])->name('saveObject'); /*  41 match(['GET','POST'];/{id?} */ 
  Route::match(['GET','POST'],trans('routes.profile'),[BackendController::class, 'profile'])->name('profile'); /* 39 match(['GET','POST'] */ 
  Route::get('/deletePhoto/{id}', [BackendController::class, 'deletePhoto'])->name('deletePhoto');   
  Route::match(['GET','POST'],trans('routes.saveroom').'/{id?}', [BackendController::class, 'saveRoom'])->name('saveRoom');   
  Route::get(trans('routes.deleteroom').'/{id}', [BackendController::class, 'deleteRoom'])->name('deleteRoom');   
  
  Route::get('/deleteArticle/{id}', [BackendController::class, 'deleteArticle'])->name('deleteArticle'); 
  Route::post('/saveArticle/{id?}', [BackendController::class, 'saveArticle'])->name('saveArticle'); 
  
  Route::get('/cities',[BackendController::class, 'cities'])->name('cities.index');   
  
  Route::get('/ajaxGetReservationData', [BackendController::class, 'ajaxGetReservationData']); 
  Route::get('/ajaxSetReadNotification', [BackendController::class, 'ajaxSetReadNotification']); 
  Route::get('/ajaxGetNotShownNotifications', [BackendController::class, 'ajaxGetNotShownNotifications']); 
  Route::get('/ajaxSetShownNotifications', [BackendController::class, 'ajaxSetShownNotifications']); 
  
  Route::get('/confirmReservation/{id}', [BackendController::class, 'confirmReservation'])->name('confirmReservation'); 
  Route::get('/deleteReservation/{id}', [BackendController::class, 'deleteReservation'])->name('deleteReservation'); 

  
  
  Route::post('addCity', function(Request $request){
    // Create a new instance of the City model
    $city = new App\Models\City;
    // Assign values to model’s attributes
    $city->name = $request->input('name');
    // Insert the record in the DB
    $city->save();
    // Display the new record containing the city
    return redirect()->route('cities.index');
    })->name('addCity'); 

    //Route::post('cities/{id}', [CityController::class, 'destroy'])->name('cities.destroy');

  Route::resource('/cities', CityController::class);
  
  Route::get(trans('routes.deleteobject').'/{id}', [BackendController::class, 'deleteObject'])->name('deleteObject'); 
    
});


Auth::routes(); /* Lecture 7 */



/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
*/


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); /* Lecture 7 */

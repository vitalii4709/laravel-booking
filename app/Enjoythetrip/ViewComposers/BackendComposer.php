<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Enjoythetrip\ViewComposers;

use Illuminate\View\View; 
use App\Models\Notification; 
use Illuminate\Support\Facades\Auth; 

class BackendComposer {
    
    public function compose(View $view)
    {
        $view->with('notifications', Notification::where('user_id', Auth::user()->id )->where('status',0)->get());
    }
    
}

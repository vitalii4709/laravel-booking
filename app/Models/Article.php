<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory;
    use \App\Enjoythetrip\Presenters\ArticlePresenter; 
    
    protected $guarded = [];
    
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function users()
    {
        return $this->morphToMany('App\Models\User', 'likeable');
    }
    
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
    
    public function object()
    {
        return $this->belongsTo('App\Models\TouristObject','object_id');
    }
    
    public function isLiked()
    {
        return $this->users()->where('user_id', Auth::user()->id)->exists();
    }
}

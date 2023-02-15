<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class TouristObject extends Model
{
    use HasFactory;
    use \App\Enjoythetrip\Presenters\ObjectPresenter; 
    
    protected $table = 'objects';
    
    protected $fillable = ['name', 'user_id', 'city_id', 'description'];
    protected $quarded = [];
    
    public $timestamps = false;
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('name', 'asc');
    }
    
    public function city() 
    {
        return $this->belongsTo('App\Models\City');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function photos()
    {
        return $this->morphMany('App\Models\Photo', 'photoable');
    }
    
    public function users()
    {
        return $this->morphToMany('App\Models\User', 'likeable');
    }
    
    public function address()
    {
        return $this->hasOne('App\Models\Address','object_id');
    }
    
    public function rooms()
    {
        return $this->hasMany('App\Models\Room','object_id');
    }
    
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
    
    public function articles()
    {
        return $this->hasMany('App\Models\Article','object_id');
    }
    
    public function isLiked()
    {
        return $this->users()->where('user_id', Auth::user()->id)->exists();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    
    use \App\Enjoythetrip\Presenters\CommentPresenter;

    protected $guarded = [];
        
    public $timestamps = false; 
    
    public function commentable()
    {
        return $this->morphTo();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

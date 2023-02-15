<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    
    public $timestamps = false; 
    protected $guarded = ['id']; 
    //protected $fillable = ['name']; 
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }
}

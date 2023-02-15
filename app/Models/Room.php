<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;
use App\Models\TouristObject;
use App\Models\Reservation;

class Room extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
    
    public function object()
    {
        return $this->belongsTo(TouristObject::class,'object_id');
    }
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    
}

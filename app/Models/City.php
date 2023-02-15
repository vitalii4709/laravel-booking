<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\TouristObject;
use App\Models\Reservation;

class City extends Model
{
    use HasFactory;
    
    //protected $table = 'cities';
    
    protected $fillable = ['name'];
    protected $guarded = [];
    public $timestamps = false;
    
    public function rooms()
    {
        return $this->hasManyThrough(Room::class, TouristObject::class,'city_id','object_id');
    }
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

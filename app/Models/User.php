<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Photo;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \App\Enjoythetrip\Presenters\UserPresenter;
    
    public static $roles = []; 

    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
        
    public function objects()
    {
        return $this->morphedByMany('App\Models\TouristObject', 'likeable');
    }
    
    public function larticles()
    {
        return $this->morphedByMany('App\Models\Article', 'likeable');
    }
    
    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    
    public function unotifications()
    {
        return $this->hasMany('App\Models\Notification');
    }
    
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
    
    
    public function hasRole(array $roles)
    {

        foreach($roles as $role)
        {
            
            if(isset(self::$roles[$role])) 
            {
                if(self::$roles[$role])  return true;

            }
            else
            {
                self::$roles[$role] = $this->roles()->where('name', $role)->exists();
                if(self::$roles[$role]) return true;
            }
            
        }
        

        return false;
 
    }
}

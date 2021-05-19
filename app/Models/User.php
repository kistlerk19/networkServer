<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'user_identifier'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function status_updates()
    {
        return $this->hasMany(StatusUpdate::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    
    public function houses()
    {
        return $this->hasMany(House::class);
    }

    public function images()
    {
        return $this->hasMany(UserFile::class);
    }
    
    
    public function friends()
    {
        return $this->belongsToMany(User::class, 'user_friends', 'user_id', 'friend_id');
    }

    public function toArray()
    {
        return [
            'identifier' => $this->user_identifier,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'friends' => $this->friends,
            'images' => $this->images,
            'status_updates' => $this->status_updates,
            'posts' => $this->posts,
            'houses' => $this->houses,
            'experiences' => $this->experiences,
            'activities' => $this->activities,
        ];
    }
}

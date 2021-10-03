<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Relation Many to many with SPECIALIZATION
    public function specializations(){
        return $this->belongsToMany('App\Specialization');
    }

    // Relation Many to many with SPONSORS
    public function sponsors(){
        return $this->belongsToMany('App\Sponsor');
    }

    // Relation 1 to many with REVIEWS
    public function reviews(){
        return $this->hasMany('App\Review');
    }

    // Relation 1 to many with MESSAGES
    public function messages(){
        return $this->hasMany('App\Message');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'slug', 'services', 'address','email', 'password', 'photo', 'phone', 'cv'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

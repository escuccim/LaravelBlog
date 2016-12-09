<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /* A user can have multiple articles */
    public function blogs () {
    	return $this->hasMany('App\Blog');
    }
    
    public function comments(){
    	return $this->hasMany('App\BlogComment');
    }
    
    public function isAdmin(){
    	return $this->type;
    }
    
    public function userType(){
    	if($this->type == 0){
    		return 'User';
    	} elseif($this->type == 1){
    		return 'Admin';
    	}
    }
}

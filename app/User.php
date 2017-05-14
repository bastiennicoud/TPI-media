<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'role'
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
    * Permet d'obtenir les posts de l'utilisateur
    */
    public function posts()
    {
      return $this->hasMany('App\Post');
    }

    /**
    * Permet d'obtenir les commentaires de l'utilisateur
    */
    public function comments()
    {
      return $this->hasMany('App\Comment');
    }
}

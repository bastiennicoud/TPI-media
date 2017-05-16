<?php

// -----------------------------------------------------------------------------
// Model User
//
// Ce model va permettre d'intéragir avec la table users (en utilisant,
// eloquent, l'ORM de laravel)
// -----------------------------------------------------------------------------

namespace App;

// namespace importés par laravel
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

// ce model etend de la classe Authenticable (qui est une version de la classe de model classique avec des methodes en plus grffées)
class User extends Authenticatable
{
    use Notifiable;

    /**
     * Definis les attributs massivement assignables
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'role'
    ];

    /**
     * Definis les attributs masqués si on fais une requète globale
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    /**
    * Permet d'indiquer la relation avec les posts
    */
    public function posts()
    {
      return $this->hasMany('App\Post');
    }

    /**
    * Permet d'indiquer la relation avec les commentaires
    */
    public function comments()
    {
      return $this->hasMany('App\Comment');
    }
}

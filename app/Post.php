<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  /**
  * Permet d'obtenir la photo coresspondant au post
  */
  public function poster()
  {
    return $this->hasOne('App\Poster');
  }

  /**
  * Permet d'obtenir l'utilisateur correspondant au post'
  */
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  /**
  * Permet d'obtenir les commentaires liés au post
  */
  public function comments()
  {
    return $this->hasMany('App\Comment');
  }

}

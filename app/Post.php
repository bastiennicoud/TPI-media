<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  /**
   * Definis les attributs editables massivement
   *
   * @var array
   */
  protected $fillable = [
      'title', 'slug', 'date', 'hat', 'content', 'online', 'user_id', 'poster_id'
  ];

  /**
  * Permet d'obtenir la photo coresspondant au post
  */
  public function poster()
  {
    return $this->belongsTo('App\Poster');
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

  /**
   * Definis les attributs editables massivement
   *
   * @var array
   */
  protected $fillable = [
      'content', 'user_id', 'post_id', 'image_id'
  ];

  /**
  * Permet d'obtenir le post lié
  */
  public function post()
  {
    return $this->belongsTo('App\Post');
  }

  /**
  * Permet d'obtenir l'utilisateur correspondant au commentaire
  */
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  /**
  * Permet d'obtenir l'eventuelle photo postée avec le commentaire
  */
  public function image()
  {
    return $this->belongsTo('App\Image');
  }
}

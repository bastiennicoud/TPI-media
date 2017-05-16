<?php

// -----------------------------------------------------------------------------
// Model Comment
//
// Ce model va permettre d'intéragir avec la table comments (en utilisant,
// eloquent, l'ORM de laravel)
// -----------------------------------------------------------------------------

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
  * Permet d'indiquer la relation avec les post liés
  */
  public function post()
  {
    return $this->belongsTo('App\Post');
  }

  /**
  * Permet d'indiquer la relation avec un utilisateur
  */
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  /**
  * Permet d'indiquer la relation avec une eventuelle image
  */
  public function image()
  {
    return $this->belongsTo('App\Image');
  }

  /**
  * Mets en forme automatiquement la date a chaque requète
  */
  public function getCreatedAtAttribute($attribute)
  {
    setlocale(LC_TIME, "fr_FR");
    // permet de retouner la date sous forme de "Mardi 19 mai 1017"
    return ucfirst(strftime('%A %d %B %Y', strtotime($attribute)));
  }
}

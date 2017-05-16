<?php

// -----------------------------------------------------------------------------
// Model Post
//
// Ce model va permettre d'intéragir avec la table posts (en utilisant,
// eloquent, l'ORM de laravel)
// -----------------------------------------------------------------------------

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
      'title', 'slug', 'date', 'hat', 'content', 'online', 'user_id', 'poster_id', 'video'
  ];

  /**
  * Permet d'indiquer la liaison avec un poster
  */
  public function poster()
  {
    return $this->belongsTo('App\Poster');
  }

  /**
  * Permet d'indiquer la liaison avec un utilisateur
  */
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  /**
   * Permet d'indiquer la liaison avec des commentaires
   */
  public function comments()
  {
      return $this->hasMany('App\Comment');
  }

  /**
  * Mets en forme automatiquement la date
  */
  public function getDateAttribute($attribute)
  {
    setlocale(LC_TIME, "fr_FR");
    // permet de retouner la date sous forme de "Mardi 19 mai 1017"
    return ucfirst(strftime('%A %d %B %Y', strtotime($attribute)));
  }
}

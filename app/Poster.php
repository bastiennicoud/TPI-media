<?php

// -----------------------------------------------------------------------------
// Model Poster
//
// Ce model va permettre d'intéragir avec la table posters (en utilisant,
// eloquent, l'ORM de laravel)
// -----------------------------------------------------------------------------

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{

  /**
   * Definis les attributs que l'on a le droit d'assigner en masse
   *
   * @var array
   */
  protected $fillable = [
      'url'
  ];

  /**
  * Permet d'indiquer la relation avec les posts
  */
  public function user()
  {
    return $this->hasOne('App\Post');
  }

}

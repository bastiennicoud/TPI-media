<?php

// -----------------------------------------------------------------------------
// Model Image
//
// Ce model va permettre d'intéragir avec la table images (en utilisant,
// eloquent, l'ORM de laravel)
// -----------------------------------------------------------------------------

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

  /**
   * Definis les attributs editables massivement
   *
   * @var array
   */
  protected $fillable = [
      'url'
  ];

  /**
  * Permet d'indiquer la liaison avec un commentaires
  */
  public function comment()
  {
    return $this->hasOne('App\Comment');
  }
}

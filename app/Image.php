<?php

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
  * Permet d'obtenir le post correspondant au poster
  */
  public function comment()
  {
    return $this->hasOne('App\Comment');
  }
}

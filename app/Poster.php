<?php

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
  * Permet d'obtenir le post correspondant au poster
  */
  public function user()
  {
    return $this->belongsTo('App\Post');
  }

}

<?php

// -----------------------------------------------------------------------------
// PostsController
//
// Ce controller se charge de tous les traitements liés au posts (articles)
// nouveau post, edition, suppression, affichage
// -----------------------------------------------------------------------------

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{

  /**
   * Création d'un nouveau post
   *
   * @return Response
   */
  public function newpost(Request $request) {
    return 'tutu';
  }



  /**
   * Création d'un nouveau post
   *
   * @return Response
   */
  public function editpost(Request $request) {
    return 'tutu';
  }
}

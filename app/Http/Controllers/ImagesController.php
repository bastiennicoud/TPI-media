<?php

// -----------------------------------------------------------------------------
// ImagesController
//
// Ce controller se charge de toutes les réceptions d'images
// enregistrement, redimentionnement
// -----------------------------------------------------------------------------

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagesController extends Controller
{

  /**
   * Methode pour le changement de sa photo de profile
   *
   * @return Response
   */
  public function newprofilephoto(Request $request) {

    // appel de la facade de connexion de laravel
    if(Auth::attempt(['name' => $request->input('name'), 'password' => $request->input('password')])){
      $userinfos = [
        'connected' => true,
        'username' =>  Auth::user()->name,
        'userimage' =>  Auth::user()->image,
        'userrole' =>  Auth::user()->role
      ];
      return response()->json($userinfos);
    } else {
      $userinfos = [
        'connected' => false
      ];
      return response()->json($userinfos);
    }

  }
}

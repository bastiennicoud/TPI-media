<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersauthController extends Controller
{

  /**
   * Inscription de l'utilisateur
   *
   * @return Response
   */
  public function register(Request $request) {
    $datas = $request->all();
    return response()->json($datas);
  }

}

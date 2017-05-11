<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsersauthController extends Controller
{

  /**
   * Inscription de l'utilisateur
   *
   * @return Response
   */
  public function register(Request $request) {
    //$datas = $request->all();

    $validator = Validator::make($request->all(), [
      'name' => 'required|unique:users|min:6|max:255',
      'email' => 'required|email|unique:users|max:255',
      'password' => 'required|confirmed|min:6|max:50',
      'password_confirmation' => 'required'
    ]);
    return response()->json($validator->messages());
  }

}

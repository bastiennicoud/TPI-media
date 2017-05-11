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

    $validator = Validator::make($request->all(), [
      'name' => 'required|unique:users|min:6|max:100',
      'email' => 'required|email|unique:users|max:255',
      'password' => 'required|confirmed|min:6|max:50',
      'password_confirmation' => 'required'
    ], [
      'name.required' => 'Le nom d\'utilisateur n\'a pas été renseigné.',
      'name.unique' => 'Ce nom d\'utilisateur existe déja.',
      'name.min' => 'Le nom d\'utilisateur doit faire au moins 6 caractéres.',
      'name.max' => 'Le nom d\'utilisateur peut faire maximum 100 caractéres.',
      'email.required' => 'L\'email n\'a pas été renseigné.',
      'email.email' => 'L\'email n\'est pas valide.',
      'email.unique' => 'Cet email est déja utilisé pour un autre compte.',
      'email.max' => 'L\'email peut faire maximum 200 caractéres.',
      'password.required' => 'Le mot de passe n\'a pas été renseigné.',
      'password.confirmed' => 'Le mot de passe n\'est pas correctement confirmé',
      'password.min' => 'Le mot de passe doit faire au moins 6 caractéres.',
      'password.max' => 'Le mot de passe peut faire maximum 50 caractéres.',
      'password_confirmation.required' => 'La confirmation du mot de passe n\'a pas été renseigné.'
    ]);

    if($validator->fails() === true){
      return response()->json($validator->messages());
    } else {
      return response()->json(true);
    }

  }

}

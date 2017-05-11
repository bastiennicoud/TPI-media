<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersauthController extends Controller
{

  /**
   * Methode chargée d'inscrire un nouvel utilisateur
   *
   * @return Response
   */
  public function register(Request $request) {

    // validation des données postées
    $validator = Validator::make($request->all(), [
      // le champ a valider, puis les regles de validation
      'name' => 'required|unique:users|min:6|max:100',
      'email' => 'required|email|unique:users|max:255',
      'password' => 'required|confirmed|min:6|max:50',
      'password_confirmation' => 'required'
    ], [
      // messages d'erreurs pour chaque type de validation
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

    // verification de l'etat de la validation
    if($validator->fails() === true){
      // si la validation a échoué ou renvoie les erreurs au client
      return response()->json($validator->messages());
    } else {
      // si la validation est réussie on peut enregistrer l'utilisateur
      User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'image' => '/ressources/profilephotos/default.png',
        'role' => 3
      ]);
      return response()->json(true);
    }

  }

  /**
   * Methode chargée de connecter un utilisateur
   *
   * @return Response
   */
  public function register(Request $request) {

    // appel de la fonction de connexion de laravel


  }

}

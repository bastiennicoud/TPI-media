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
  public function login(Request $request) {

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



  /**
   * Methode chargée de verifier si un utilisateur est connecté
   *
   * @return Response
   */
  public function logged(Request $request) {

    // appel de la facade de verification si l'utilisateur est connecté
    return response()->json(Auth::check());

  }



  /**
   * Methode chargée de retourner les infos générales liées a l'utilisateur
   *
   * @return Response
   */
  public function user(Request $request) {

    // On va récuperer les infos de l'utilisateur
    if(Auth::check()){
      $userinfos = [
        'connected' => true,
        'username' =>  $request->user()->name,
        'userimage' =>  $request->user()->image,
        'userrole' =>  $request->user()->role
      ];
    } else {
      $userinfos = [
        'connected' => false,
        'username' =>  '',
        'userimage' =>  '/ressources/profilephotos/default.png',
        'userrole' =>  3
      ];
    }
    return response()->json($userinfos);

  }



  /**
   * Methode chargée de déconnecter un utilisateur
   *
   * @return Response
   */
  public function logout(Request $request) {

    // appel de la facade de deconnexion de laravel
    Auth::logout();
    return response()->json(true);

  }



  /**
   * Methode chargée de la modification des informations de l'utilisateur
   *
   * @return Response
   */
  public function modifyinfos(Request $request) {

    // on verifie si l'utilisateur est bien loggé
    if(!Auth::check()){
      // si ce n'est pas le cas, on lui renvoie qu'il n'a pas le droit d'effectuer cette action
      $userupdate = [
        'permission' => false,
        'messages' => [
          'permission' => "Vous n'avez pas l'acces a cette action."
        ]
      ];
      return response()->json($userupdate);
    } else {
      // si il est bien connecté
      // validation des données postées
      $validator = Validator::make($request->all(), [
        // le champ a valider, puis les regles de validation
        'name' => 'required|unique:users|min:6|max:100',
        'email' => 'required|email|unique:users|max:255'
      ], [
        // messages d'erreurs pour chaque type de validation
        'name.required' => 'Le nom d\'utilisateur n\'a pas été renseigné.',
        'name.unique' => 'Ce nom d\'utilisateur existe déja.',
        'name.min' => 'Le nom d\'utilisateur doit faire au moins 6 caractéres.',
        'name.max' => 'Le nom d\'utilisateur peut faire maximum 100 caractéres.',
        'email.required' => 'L\'email n\'a pas été renseigné.',
        'email.email' => 'L\'email n\'est pas valide.',
        'email.unique' => 'Cet email est déja utilisé.'
      ]);

      // on verifie si la validation a bien fonctionné
      if($validator->fails()){
        // si elle a échoué, on renvoie les erreurs au client
        $userupdate = [
          'permission' => true,
          'messages' => $validator->messages()
        ];
        return response()->json($userupdate);
      } else {
        // si la validation est ok
        $request->user()->name = $request->input('name');
        $request->user()->email = $request->input('email');
        $request->user()->save();
        $userupdate = [
          'permission' => true,
          'messages' => [
            'update' => "Vous informations on bien été mises a jour"
          ]
        ];
        return response()->json($userupdate);
      }
    }
/*
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
*/
  }

}

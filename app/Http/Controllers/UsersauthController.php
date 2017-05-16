<?php

// -----------------------------------------------------------------------------
// UsersauthController
//
// Ce controller contient toutes les methodes qui on attrait a la gestion de l'utilisateur
// Création, Connexion, Modification, deconnexion
// -----------------------------------------------------------------------------

namespace App\Http\Controllers;

// on indique les différents namespaces qui vont être utilisés par le controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Post;

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
      'name.required' => 'Le nom d\'utilisateur n\'a pas été renseigné',
      'name.unique' => 'Ce nom d\'utilisateur existe déjà',
      'name.min' => 'Le nom d\'utilisateur doit faire au moins 6 caractères',
      'name.max' => 'Le nom d\'utilisateur peut faire maximum 100 caractères',
      'email.required' => 'L\'email n\'a pas été renseigné',
      'email.email' => 'L\'email n\'est pas valide',
      'email.unique' => 'Cet email est déja utilisé pour un autre compte',
      'email.max' => 'L\'email peut faire maximum 200 caractéres',
      'password.required' => 'Le mot de passe n\'a pas été renseigné',
      'password.confirmed' => 'Le mot de passe n\'est pas correctement confirmé',
      'password.min' => 'Le mot de passe doit faire au moins 6 caractères',
      'password.max' => 'Le mot de passe peut faire maximum 50 caractères',
      'password_confirmation.required' => 'La confirmation du mot de passe n\'a pas été renseignée'
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
    // la facade Auth::attempt se caharge de créeer la session pour persister la connxion ainsi que de vérifier le mot de passe
    if(Auth::attempt(['name' => $request->input('name'), 'password' => $request->input('password')])){
      // si l'utilisateur est bien connecté on renvoie les infos de base au client pour mettre a jour la vue en conséquences
      $userinfos = [
        'connected' => true,
        'username' =>  Auth::user()->name,
        'userimage' =>  Auth::user()->image,
        'userrole' =>  Auth::user()->role,
        'notification' => Post::where('online', 1)->whereRaw('date > NOW() and date < NOW() + INTERVAL 1 WEEK')->get()->count()
      ];
      return response()->json($userinfos);
    } else {
      // si la connexion échoue on renvoie une réponse négative
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
    // Auth::check retourne true ou false
    return response()->json(Auth::check());

  }



  /**
   * Methode chargée de retourner les infos générales liées a l'utilisateur
   *
   * @return Response
   */
  public function user(Request $request) {

    // On va récuperer les infos de l'utilisateur si il est connecté
    if(Auth::check()){
      $userinfos = [
        'connected' => true,
        'username' =>  $request->user()->name,
        'userimage' =>  $request->user()->image,
        'userrole' =>  $request->user()->role,
        'notification' => Post::where('online', 1)->whereRaw('date > NOW() and date < NOW() + INTERVAL 1 WEEK')->get()->count()
      ];
    } else {
      // si l'utilisateur n'est pas connecté on renvoie les informations de base
      $userinfos = [
        'connected' => false,
        'username' =>  '',
        'userimage' =>  '/ressources/profilephotos/default.png',
        'userrole' =>  3,
        'notification' => 0
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
   * Methode chargée de la modification du nom de l'utilisateur
   *
   * @return Response
   */
  public function modifyname(Request $request) {

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
        'name' => 'required|unique:users|min:6|max:100'
      ], [
        // messages d'erreurs pour chaque type de validation
        'name.required' => 'Le nom d\'utilisateur n\'a pas été renseigné',
        'name.unique' => 'Ce nom d\'utilisateur existe déjà',
        'name.min' => 'Le nom d\'utilisateur doit faire au moins 6 caractères',
        'name.max' => 'Le nom d\'utilisateur peut faire maximum 100 caractères'
      ]);

      // on verifie si la validation a bien fonctionné
      if($validator->fails()){
        // si elle a échoué, on renvoie les erreurs au client
        $userupdate = [
          'permission' => false,
          'messages' => $validator->messages()
        ];
        return response()->json($userupdate);
      } else {
        // si la validation est ok
        $request->user()->name = $request->input('name');
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
  }



  /**
   * Methode chargée de la modification de l'email de l'utilisateur
   *
   * @return Response
   */
  public function modifyemail(Request $request) {

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
        'email' => 'required|unique:users|email|max:100'
      ], [
        // messages d'erreurs pour chaque type de validation
        'email.required' => 'L\'e-mail n\'a pas été renseigné',
        'email.email' => 'L\'e-mail n\'est pas valide',
        'email.unique' => 'Cet e-mail est déja utilisé',
        'email.max' => 'L\'e-mail peut faire maximum 200 caractères'
      ]);

      // on verifie si la validation a bien fonctionné
      if($validator->fails()){
        // si elle a échoué, on renvoie les erreurs au client
        $userupdate = [
          'permission' => false,
          'messages' => $validator->messages()
        ];
        return response()->json($userupdate);
      } else {
        // si la validation est ok
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
  }



  /**
   * Methode chargée de la mise a jour du mot de passe de l'utilisateur
   *
   * @return Response
   */
  public function modifypass(Request $request) {

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
        'password_old' => 'required|min:6|max:100',
        'password' => 'required|confirmed|min:6|max:50',
        'password_confirmation' => 'required'
      ], [
        // messages d'erreurs pour chaque type de validation
        'password_old.required' => 'L\'ancien mot de passe n\'a pas été renseigné',
        'password_old.min' => 'Le mot de passe doit faire au moins 6 caractères',
        'password_old.max' => 'Le mot de passe peut faire maximum 50 caractères',
        'password.required' => 'Le mot de passe n\'a pas été renseigné',
        'password.confirmed' => 'Le mot de passe n\'est pas correctement confirmé',
        'password.min' => 'Le mot de passe doit faire au moins 6 caractères',
        'password.max' => 'Le mot de passe peut faire maximum 50 caractères',
        'password_confirmation.required' => 'La confirmation du mot de passe n\'a pas été renseigné'
      ]);

      // on verifie si la validation a bien fonctionné
      if($validator->fails()){
        // si elle a échoué, on renvoie les erreurs au client
        $userupdate = [
          'permission' => false,
          'messages' => $validator->messages()
        ];
        return response()->json($userupdate);
      } else {
        // si la validation est ok
        // on vérifie que l'ancien mot de passe est le bon
        if(Hash::check($request->input('password_old') ,$request->user()->password)){
          // si l'ancien mot de passe est le bon
          // on peut enregistrer le nouveau mot de passe sous forme de hash
          $request->user()->password = Hash::make($request->input('password'));
          $request->user()->save();
          $userupdate = [
            'permission' => true,
            'messages' => [
              'update' => "Votre mot de passe a bien été mis a jour"
            ]
          ];
          return response()->json($userupdate);
        } else {
          // si l'ancien mot de passe n'est pas le bon
          $userupdate = [
            'permission' => false,
            'messages' => [
              'update' => [0 => "Vous n'avez pas rentré votre mot de passe actuel correctement."]
            ]
          ];
          return response()->json($userupdate);
        }
      }
    }
  }
}

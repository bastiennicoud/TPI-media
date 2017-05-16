<?php

// -----------------------------------------------------------------------------
// ImagesController
//
// Ce controller se charge de toutes les réceptions d'images
// enregistrement, redimentionnement
// -----------------------------------------------------------------------------

namespace App\Http\Controllers;

// on indique les différents namespaces qui vont être utilisés par le controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Hash;
use App\Poster;
use App\Image;

class ImagesController extends Controller
{

  /**
   * Methode pour le changement de sa photo de profile
   * @param object Request
   * @return Response
   */
  public function newprofilephoto(Request $request) {

    // verfie que l'user est connecté
    // Auth:: est un facade de laravel qui permet de géréer les utilisateurs
    if(!Auth::check()){
      // si il ne l'est pas, on renvoie une erreur
      $userupdate = [
        'permission' => false,
        'messages' => [
          'permission' => [0 => "Vous n'avez pas l'acces a cette action."]
        ]
      ];
      // on retourne un reponse au format JSON
      return response()->json($userupdate);
    } else {
      // si l'utilisateur est authentifié
      // je récupere l'image et la traite avec la librairie intervention image

      // nouveau manager (l'objet qui permet de traiter des images)
      $manager = new ImageManager(['driver' => 'gd']);
      // je lui passe l'image qui vient d'étre uploadée
      $manager->make($request->file('profilephoto'))
        // je demande un redimentionnement
        ->resize(128, 128)
        // je la savegarde dans le dossier profilephotos, avec un facteur de qualité de 70 (légére compression)
        ->save('ressources/profilephotos/' . $request->user()->name . '.' . $request->file('profilephoto')->getClientOriginalExtension(), 70);

      // Je présise le nom de la nouvelle image de l'utilisateur
      $request->user()->image = '/ressources/profilephotos/' . $request->user()->name . '.' . $request->file('profilephoto')->getClientOriginalExtension();
      // Et j'enregistre cette nouvelle information dans la base de données
      $request->user()->save();

      // on retourne au client que l'operation c'est bien déroulée
      // ainsi que l'url de la nouvelle image, pour metre a jour la vue
      $userupdate = [
        'permission' => true,
        'imageurl' => $request->user()->image,
        'messages' => [
          'image' => [0 => "Votre photo de profile a bien été modifiée."]
        ]
      ];
      // on retourne un reponse au format JSON
      return response()->json($userupdate);
    }
  }



  /**
   * Methode pour l'ajout d'une affiche a un evenement
   * @param object Request
   * @return Response
   */
  public function addposter(Request $request) {

    // verfie que l'user est connecté
    if(!Auth::check()){
      // si il ne l'est pas, on renvoie une erreur
      $userupdate = [
        'permission' => false,
        'messages' => [
          'permission' => [0 => "Vous n'avez pas l'acces a cette action."]
        ]
      ];
      // on retourne un reponse au format JSON
      return response()->json($userupdate);
    } else {
      // si il l'est
      // création d'un hash unique pour sauvegarder l'image sans conflits
      $hash = str_random(30);

      // nouveau manager (l'objet qui permet de traiter des images)
      $manager = new ImageManager(['driver' => 'gd']);
      // je lui passe l'image qui vient d'étre uploadée
      $manager->make($request->file('poster'))
        // je demande un redimentionnement, en demandant de bien garder le ratio ainsi que de ne pas agrandir si l'image est plus petite
        ->resize(500, null, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();
        })
        // je la savegarde dans le dossier profilephotos, avec un facteur de qualité de 70 (légére compression)
        ->save('ressources/posters/' . $hash . '.' . $request->file('poster')->getClientOriginalExtension(), 70);


      // on ecris dans la base de donné le chemin de la nouvele image
      $poster = Poster::create(['url' => '/ressources/posters/' . $hash . '.' . $request->file('poster')->getClientOriginalExtension()]);

      // on retourne au client un message de succes, ainsi que l'id de l'image qui vient d'étre enregistré
      $userupdate = [
        'permission' => true,
        'imageid' => $poster->id,
        'messages' => [
          'image' => [0 => "Votre affiche a bien été ajoutée"]
        ]
      ];
      // on retourne un reponse au format JSON
      return response()->json($userupdate);
    }
  }



  /**
   * Methode pour l'ajout d'une image a un commentaire
   * @param object Request
   * @return Response
   */
  public function addcommentimage(Request $request) {

    // verfie que l'user est connecté
    if(!Auth::check()){
      // si il ne l'est pas, on renvoie une erreur
      $userupdate = [
        'permission' => false,
        'messages' => [
          'permission' => [0 => "Vous n'avez pas l'acces a cette action."]
        ]
      ];
      // on retourne un reponse au format JSON
      return response()->json($userupdate);
    } else {
      // si il l'est
      // création d'un hash unique pour sauvegarder l'image sans conflits
      $hash = str_random(30);

      // nouveau manager (l'objet qui permet de traiter des images)
      $manager = new ImageManager(['driver' => 'gd']);
      // je lui passe l'image qui vient d'étre uploadée
      $manager->make($request->file('image'))
        // je demande un redimentionnement, en demandant de bien garder le ratio ainsi que de ne pas agrandir si l'image est plus petite
        ->resize(400, null, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();
        })
        // je la savegarde dans le dossier profilephotos, avec un facteur de qualité de 70 (légére compression)
        ->save('ressources/images/' . $hash . '.' . $request->file('image')->getClientOriginalExtension(), 70);


      // on ecris dans la base de donné le chemin de la nouvele image
      $image = Image::create(['url' => '/ressources/images/' . $hash . '.' . $request->file('image')->getClientOriginalExtension()]);

      // on retourne au client un message de succes, ainsi que l'id de l'image qui vient d'étre enregistré
      $userupdate = [
        'permission' => true,
        'imageid' => $image->id,
        'messages' => [
          'image' => [0 => "Votre affiche a bien été ajoutée"]
        ]
      ];
      // on retourne un reponse au format JSON
      return response()->json($userupdate);
    }
  }

}

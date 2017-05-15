<?php

// -----------------------------------------------------------------------------
// ImagesController
//
// Ce controller se charge de toutes les réceptions d'images
// enregistrement, redimentionnement
// -----------------------------------------------------------------------------

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Hash;
use App\Poster;

class ImagesController extends Controller
{

  /**
   * Methode pour le changement de sa photo de profile
   *
   * @return Response
   */
  public function newprofilephoto(Request $request) {

    // verfie que l'user est connecté
    if(!Auth::check()){
      $userupdate = [
        'permission' => false,
        'messages' => [
          'permission' => [0 => "Vous n'avez pas l'acces a cette action."]
        ]
      ];
      return response()->json($userupdate);
    } else {
      // en premier je sauvegarde l'image dans le bon doosier
      //$uploadedfile = $request->file('profilephoto');
      //$file = $uploadedfile->move(public_path('ressources/profilephotos'), $request->user()->name . '.' . $uploadedfile->getClientOriginalExtension());

      // traitement de l'image avec la librairie intervention image
      $manager = new ImageManager(['driver' => 'gd']);
      $manager->make($request->file('profilephoto'))
        ->resize(128, 128)
        ->save('ressources/profilephotos/' . $request->user()->name . '.' . $request->file('profilephoto')->getClientOriginalExtension(), 80);

      // on ecris dans la base de donné le chemin de la nouvele image
      $request->user()->image = '/ressources/profilephotos/' . $request->user()->name . '.' . $request->file('profilephoto')->getClientOriginalExtension();
      $request->user()->save();

      // on retourne au client les infos
      $userupdate = [
        'permission' => true,
        'imageurl' => $request->user()->image,
        'messages' => [
          'image' => [0 => "Votre photo de profile a bien été modifiée."]
        ]
      ];
      return response()->json($userupdate);
    }
  }



  /**
   * Methode pour l'ajout d'une affiche a un evenement
   *
   * @return Response
   */
  public function addposter(Request $request) {

    // verfie que l'user est connecté
    if(!Auth::check()){
      // si il ne l'est pas
      $userupdate = [
        'permission' => false,
        'messages' => [
          'permission' => [0 => "Vous n'avez pas l'acces a cette action."]
        ]
      ];
      return response()->json($userupdate);
    } else {
      // si il l'est
      // création d'un hash unique pour sauvegarder l'image sans conflits
      $hash = str_random(30);

      // traitement de l'image avec la librairie intervention image
      $manager = new ImageManager(['driver' => 'gd']);
      $manager->make($request->file('poster'))
        ->resize(500, null, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();
        })
        ->save('ressources/posters/' . $hash . '.' . $request->file('poster')->getClientOriginalExtension(), 80);


      // on ecris dans la base de donné le chemin de la nouvele image
      $poster = Poster::create(['url' => '/ressources/posters/' . $hash . '.' . $request->file('poster')->getClientOriginalExtension()]);

      // on retourne au client les infos
      $userupdate = [
        'permission' => true,
        'imageid' => $poster->id,
        'messages' => [
          'image' => [0 => "Votre affiche a bien été ajoutée"]
        ]
      ];
      return response()->json($userupdate);
    }
  }

}

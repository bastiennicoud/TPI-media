<?php

// -----------------------------------------------------------------------------
// PostsController
//
// Ce controller se charge de tous les traitements liés au posts (articles)
// nouveau post, edition, suppression, affichage
// -----------------------------------------------------------------------------

namespace App\Http\Controllers;

// on indique les différents namespaces qui vont être utilisés par le controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Post;
use App\Comment;
use Carbon\Carbon;

class PostsController extends Controller
{

  /**
   * Renvoie a l'utilisateur tous les posts par ordre de création
   * Derniers posts ajoutés en premier
   * @param object Request
   * @return Response
   */
  public function getposts(Request $request)
  {
    $posts = Post::with('poster')->select('id', 'title', 'slug', 'date', 'hat', 'content', 'poster_id')->where('online', 1)->orderBy('created_at', 'desc')->limit(10)->get();
    return response()->json($posts);
  }



  /**
   * Renvoie a l'utilisateur tous les posts qui on eu lieu
   * @param object Request
   * @return Response
   */
  public function getpastposts(Request $request)
  {
    $posts = Post::with('poster')->select('id', 'title', 'slug', 'date', 'hat', 'content', 'poster_id')->where('online', 1)->whereRaw("date < NOW()")->limit(10)->get();
    return response()->json($posts);
  }



  /**
   * Renvoie a l'utilisateur tous les posts par date
   * Derniers posts ajoutés en premier
   * @param object Request
   * @return Response
   */
  public function getpostsbydate(Request $request)
  {
    $posts = Post::with('poster')->select('id', 'title', 'slug', 'date', 'hat', 'content', 'poster_id')->where('online', 1)->whereRaw("date > NOW()")->orderBy('date', 'asc')->limit(10)->get();
    return response()->json($posts);
  }



  /**
   * Renvoie a l'utilisateur tous evenements qui aurons lieu le mois qui viens
   * Derniers posts ajoutés en premier
   * @param object Request
   * @return Response
   */
  public function getmonthevents(Request $request)
  {
    $event = Post::select('title', 'slug', 'date')->where('online', 1)->whereRaw("date > NOW() and date < NOW() + INTERVAL 1 MONTH")->orderBy('date', 'asc')->limit(10)->get();
    return response()->json($event);
  }



  /**
   * Renvoie a l'utilisateur tous evenements qui aurons lieu la semaine qui suit
   * Derniers posts ajoutés en premier
   * @param object Request
   * @return Response
   */
  public function getweekevents(Request $request)
  {
    $posts = Post::with('poster')->select('id', 'title', 'slug', 'date', 'hat', 'content', 'poster_id')->where('online', 1)->whereRaw("date > NOW() and date < NOW() + INTERVAL 1 WEEK")->limit(10)->get();
    return response()->json($posts);
  }



  /**
   * Renvoie a l'utilisateur tous ces posts
   * @param object Request
   * @return Response
   */
  public function getpostsuser(Request $request)
  {
    $posts = Post::with('poster')->select('id', 'title', 'slug', 'date', 'hat', 'content', 'online', 'poster_id')->where('user_id', $request->user()->id)->orderBy('created_at', 'desc')->limit(10)->get();
    return response()->json($posts);
  }




  /**
   * Renvoie a l'utilisateur le post demandé en id
   * @param object Request
   * @param int Id du post à retourner
   * @return Response
   */
  public function getpost(Request $request, $postId)
  {
    $posts = Post::with('poster')->select('id', 'title', 'slug', 'date', 'hat', 'content', 'poster_id', 'video')->where('id', $postId)->get();
    return response()->json($posts);
  }



  /**
   * Renvoie a l'utilisateur le post demandé en id avec commentaires
   * @param object Request
   * @param string Le slug du post à retourner
   * @return Response
   */
  public function getpostslug(Request $request, $postSlug)
  {
    $posts = Post::with('poster', 'comments.user', 'comments.image')->select('id', 'title', 'slug', 'date', 'hat', 'content', 'poster_id', 'video')->where('slug', $postSlug)->get();
    return response()->json($posts);
  }



  /**
   * Renvoie a l'utilisateur les commentaires du post passé en paramètre
   * @param object Request
   * @param int Id du post conserné
   * @return Response
   */
  public function getcomments(Request $request, $postId)
  {
    $comments = Comment::with('user', 'image')->select('content', 'created_at', 'user_id', 'image_id')->where('post_id', $postId)->get();
    return response()->json($comments);
  }




  /**
   * Ajout d'un commentaire
   * @param object Request
   * @return Response
   */
  public function newcomment(Request $request)
  {

    // on verifie si l'utilisateur est bien connecté
    if(!Auth::check()){
      // si ce n'est pas le cas, on lui renvoie qu'il n'a pas le droit d'effectuer cette action
      $newpost = [
        'validation' => false,
        'messages' => [
          'permission' => [0 => "Connectez-vous pour poster un commentaire."]
        ]
      ];
      return response()->json($newpost);
    } else {
      // si l'utilisateur est connecté, on verifie que le commentaire est valide

      // validation des données postées
      $validator = Validator::make($request->all(), [
        // le champ a valider, puis les regles de validation
        'comment' => 'required|max:400'
      ], [
        // messages d'erreurs pour chaque type de validation
        'comment.required' => "Vous n'avez pas présisé de commentaire.",
        'comment.max' => "Un commentaire peut faire maximum 400 caractères."
      ]);

      // verification de l'etat de la validation
      if($validator->fails() === true){
        // si la validation a échoué ou renvoie les erreurs au client
        // si elle a échoué, on renvoie les erreurs au client
        $newpost = [
          'validation' => false,
          'messages' => $validator->messages()
        ];
        return response()->json($newpost);
      } else {
        // si la validation est réussie on peut enregistrer le nouveau post
        Comment::create([
          'content' => $request->input('comment'),
          'post_id' => $request->input('post'),
          'image_id' => $request->input('idimage'),
          'user_id' => $request->user()->id
        ]);

        // on renvoie un message si l'action c'est bien déroulée
        $newpost = [
          'validation' => true,
          'messages' => [
            'post' => [0 => "Votre post a correctement été ajouté."]
          ]
        ];
        return response()->json($newpost);
      }
    }
  }




  /**
   * Création d'un nouveau post
   * @param object Request
   * @return Response
   */
  public function newpost(Request $request)
  {

    // on verifie si l'utilisateur est bien connecté
    if(!Auth::check()){
      // si ce n'est pas le cas, on lui renvoie qu'il n'a pas le droit d'effectuer cette action
      $newpost = [
        'validation' => false,
        'messages' => [
          'permission' => [0 => "Vous n'avez pas l'acces a cette action."]
        ]
      ];
      return response()->json($newpost);
    } else {
      // si l'utilisateur est connecté, on verifie qu'il a l'autorisation de créer un post
      // seul les utilisateurs ayant un role en dessous de 3 peuvent créer un post
      if(!($request->user()->role <= 2)){
        $newpost = [
          'validation' => false,
          'messages' => [
            'permission' => [0 => "Vous n'avez pas l'acces a cette action."]
          ]
        ];
        return response()->json($newpost);
      } else {
        // si l'utilisateur est autorisé on peut alors valider les informations

        // validation des données postées
        $validator = Validator::make($request->all(), [
          // le champ a valider, puis les regles de validation
          'title' => 'required|unique:posts|max:60',
          'date' => 'required',
          'hat' => 'required|max:200',
          'body' => 'required',
          'idimage' => 'required'
        ], [
          // messages d'erreurs pour chaque type de validation
          'title.required' => "Vous devez présiser un titre a votre événement.",
          'title.unique' => "Un evenement portant ce nom existe déja.",
          'title.max' => "Le titre d'un événement peut faire au maximum 60 carctères",
          'date.required' => "Vous devez présiser un date a votre événement",
          'hat.required' => "Vous devez présiser un chapeau a votre événement",
          'hat.max' => "Le chapeau peut faire maximum 200 caractères",
          'body.required' => "Vous devez ajouter une description a votre événement",
          'idimage.required' => "Vous devez ajouter une affiche a votre événement"
        ]);

        // verification de l'etat de la validation
        if($validator->fails() === true){
          // si la validation a échoué ou renvoie les erreurs au client
          // si elle a échoué, on renvoie les erreurs au client
          $newpost = [
            'validation' => false,
            'messages' => $validator->messages()
          ];
          return response()->json($newpost);
        } else {
          // si la validation est réussie on peut enregistrer le nouveau post
          Post::create([
            'title' => $request->input('title'),
            'slug' => str_slug($request->input('title')),
            'date' => $request->input('date'),
            'hat' => $request->input('hat'),
            'content' => $request->input('body'),
            'online' => 0,
            'user_id' => $request->user()->id,
            'poster_id' => $request->input('idimage'),
            'video' => $request->input('video')
          ]);

          $newpost = [
            'validation' => true,
            'messages' => [
              'post' => [0 => "Votre post a correctement été ajouté."]
            ]
          ];
          return response()->json($newpost);
        }

      }
    }
  }



  /**
   * Edition d'un post
   * @param object Request
   * @return Response
   */
  public function editpost(Request $request, $postId)
  {

    // on verifie si l'utilisateur est bien connecté
    if(!Auth::check()){
      // si ce n'est pas le cas, on lui renvoie qu'il n'a pas le droit d'effectuer cette action
      $newpost = [
        'validation' => false,
        'messages' => [
          'permission' => [0 => "Vous n'avez pas l'acces a cette action."]
        ]
      ];
      return response()->json($newpost);
    } else {
      // si l'utilisateur est connecté, on verifie qu'il est propriétaire de ce post
      $post = Post::find($postId);
      if(!($request->user()->id == $post->user_id)){
        $newpost = [
          'validation' => false,
          'messages' => [
            'permission' => [0 => "Vous n'avez pas l'acces a cette action."]
          ]
        ];
        return response()->json($newpost);
      } else {
        // si l'utilisateur est autorisé on peut alors valider les informations

        // validation des données postées
        $validator = Validator::make($request->all(), [
          // le champ a valider, puis les regles de validation
          'title' => [
            'required',
            'max:60',
            // Rule:: me permet de définir un regle custom
            // ici lors de la verification que le titre est unique
            // je lui demande d'ignorer son propre titre
            Rule::unique('posts')->ignore($postId)
          ],
          'date' => 'required',
          'hat' => 'required|max:200',
          'body' => 'required',
          'idimage' => 'required'
        ], [
          // messages d'erreurs pour chaque type de validation
          'title.required' => "Vous devez présiser un titre a votre événement.",
          'title.unique' => "Un evenement portant ce nom existe déja.",
          'title.max' => "Le titre d'un événement peut faire au maximum 60 carctères",
          'date.required' => "Vous devez présiser un date a votre événement",
          'hat.required' => "Vous devez présiser un chapeau a votre événement",
          'hat.max' => "Le chapeau peut faire maximum 200 caractères",
          'body.required' => "Vous devez ajouter une description a votre événement",
          'idimage.required' => "Vous devez ajouter une affiche a votre événement"
        ]);

        // verification de l'etat de la validation
        if($validator->fails() === true){
          // si la validation a échoué ou renvoie les erreurs au client
          // si elle a échoué, on renvoie les erreurs au client
          $newpost = [
            'validation' => false,
            'messages' => $validator->messages()
          ];
          return response()->json($newpost);
        } else {
          // si la validation est réussie on peut enregistrer le nouveau post
          Post::where('id', $postId)->update([
            'title' => $request->input('title'),
            'slug' => str_slug($request->input('title')),
            'date' => $request->input('date'),
            'hat' => $request->input('hat'),
            'content' => $request->input('body'),
            'online' => 0,
            'user_id' => $request->user()->id,
            'poster_id' => $request->input('idimage'),
            'video' => $request->input('video')
          ]);

          $newpost = [
            'validation' => true,
            'messages' => [
              'post' => [0 => "Votre post a correctement été ajouté."]
            ]
          ];
          return response()->json($newpost);
        }
      }
    }
  }



  /**
   * Permet de mettee la valeur online a true ou false
   * @param object Request
   * @return Response
   */
  public function postonline(Request $request, $postId)
  {

    // verification que l'utilisateur est loggé
    if (Auth::check()) {
      // si l'utilisateur est connecté, on verifie qu'il est propriétaire de ce post
      $post = Post::find($postId);
      if(($request->user()->id == $post->user_id)){
        // avec ce if je passe la valeur à l'inverse que ce qu'elle est
        if($post->online == 0){
          $post->online = 1;
        } else {
          $post->online = 0;
        }
        $post->save();
        return response()->json(true);
      } else {
        return response()->json(false);
      }
    } else {
      return response()->json(false);
    }
  }




  /**
   * Suppression d'un post
   * @param object Request
   * @return Response
   */
  public function deletepost(Request $request, $postId)
  {

    // on verifie si l'utilisateur est bien connecté
    if(!Auth::check()){
      // si ce n'est pas le cas, on lui renvoie qu'il n'a pas le droit d'effectuer cette action
      $newpost = [
        'validation' => false,
        'messages' => [
          'permission' => [0 => "Vous n'avez pas l'acces a cette action."]
        ]
      ];
      return response()->json($newpost);
    } else {
      // si l'utilisateur est connecté, on verifie qu'il est propriétaire de ce post
      $post = Post::find($postId);
      //sdd($post);
      if(!($request->user()->id == $post->user_id)){
        $newpost = [
          'validation' => false,
          'messages' => [
            'permission' => [0 => "Vous n'avez pas l'acces a cette action."]
          ]
        ];
        return response()->json($newpost);
      } else {
        // si l'utilisateur est autorisé on peut alors supprimer le post

        // supression du post concerné
        Post::find($postId)->delete();

        $newpost = [
          'validation' => true,
          'messages' => [
            'post' => [0 => "Votre post a bien été supprimé"]
          ]
        ];
        return response()->json($newpost);

      }
    }
  }
}

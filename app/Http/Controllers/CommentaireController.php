<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Avi;
use Illuminate\Support\Facades\Redirect;

class CommentaireController extends Controller
{

    
    public function formcon($id_loca)
    {
        $location = DB::table('_locations')
                ->where('id', '=', $id_loca)
                ->select('*')
                ->get();

        
               
                if (Auth::check()) {
                    $id = auth()->user()->id;
                    $location = DB::table('notifications')
                ->where('id_loca', '=', "$id_loca")
                ->where('id_user', '=', "$id")
                ->update(['lue' => 'oui']);
                    $notifications = DB::table('notifications')
                    ->select('notifications.*','_locations.date_fin_loc')
                    ->join('_locations','_locations.id','=','notifications.id_loca')
                    ->where('notifications.id_user', '=', $id)
                    ->get();  
                }
                else $notifications=NULL;

                return view('commentaire', ['location' => $location, 'id_loca' => $id_loca,'notifications'=>$notifications]);
            
    }
    public function formcreate(Request $request, $id_loca)
    {
       $request -> validate([
        'description_objet' => 'required',
        
       ]);

       $location = DB::table('_locations')
       ->where('id', '=', $id_loca)
       ->select('id_annonce', 'id_part')
       ->first();

       $commentaire =new Avi();
       $commentaire -> description_objet= $request ->description_objet;
       $commentaire -> description_user= $request ->description_user;
       $commentaire->score_objet= $request->input('product_rating', 5);
       if ($commentaire->score_objet !== null) {
        $commentaire->type_objet = ($commentaire->score_objet >= 3) ? 'positif' : 'negatif';
    } else {
        $commentaire->type_objet = '';
    }
    $commentaire->score_user= $request->input('part_rating', 5);
    if ($commentaire->score_user !== null) {
     $commentaire->type_user = ($commentaire->score_user >= 3) ? 'positif' : 'negatif';
 } else {
     $commentaire->type_user = '';
 }


       $commentaire->user_id = auth()->user()->id;
       $commentaire -> id_profile= $location ->id_part;
       $commentaire->id_annonce =$location->id_annonce;
       $commentaire -> id_location= $id_loca;
      
      
       $commentaire->save();
       
      // return Redirect::route('Annonce', ['id' => $location->id_annonce]);
      return redirect('/Annonce'.$location->id_annonce)->with('comment_success', 'Le formulaire a été enregistré avec succès');

    // return view('Annonce', ['location' => $location, 'id_loca' => $id_loca,'user2' => $user2]);
     //  return redirect()->route('formcon', $id_loca)->with('success', 'Le formulaire d\'évaluation a été bien enregistré');
   //  return redirect()->route('Annonce', ['id' => $annonceId])->with('success', 'Le formulaire d\'évaluation a été bien enregistré');
   //return redirect()->route('Annonce', ['id' => $annonce->id]);
    }
    
}
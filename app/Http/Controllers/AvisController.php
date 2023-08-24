<?php

namespace App\Http\Controllers;

use App\Models\Avi;
use App\Models\Location;
use Illuminate\Support\Facades\Redirect;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
   
        public function store(Request $request)
        {
            $request->validate([
                'description' => 'required',
       
            ]);
            $location = DB::table('_locations')
            ->where('id', '=', "$request->id_loca")
            ->select('*')
            ->get();  
       //  dd($location);
            $avis = new Avi();
            $avis->description_user = $request->description;
            $avis->description_objet = "";
            $avis->id_profile = $request->id_profile;
            $avis->score_user = $request->score_user;
            $avis->user_id =$location[0]->id_client;
            $avis->id_annonce =$location[0]->id_annonce;
            $avis->id_location=$request->id_loca;
            $avis->save();
           // return Redirect::route('/Annonce{id}', ['id' =>$location[0]->id_annonce]);
            return redirect('/Annonce'.$location[0]->id_annonce)->with('successcomment', 'Votre commentaire a été ajouté avec succès');
            //return redirect()->back();
        }

        public function addComment($id_loca){

            $location = DB::table('_locations')
            ->where('id', '=', "$id_loca")
            ->select('*')
            ->get();  
            
       
             
            $client = DB::table('users')
            ->where('id', '=', $location[0]->id_client)
            ->select('*')
            ->get();  

            $user = Auth::user();

            if (Auth::check()) {
    
            $notifications = DB::table('notifications')
                        ->where('notifications.id_user', '=', $user->id)
                        ->get();  


             $location = DB::table('notifications')
             ->where('id_loca', '=', "$id_loca")
             ->where('id_user', '=', "$user->id")
             ->update(['lue' => 'oui']);
            }
    
           else 
            $notifications=null;

            

            return view('avisPartenaire',['location'=>$id_loca,'client'=>$client,'notifications'=>$notifications,]);


    }

    public function ProfilClient($id_user){
        if (Auth::check()) {
            $id = auth()->user()->id;
            $notifications = DB::table('notifications')
            ->select('notifications.*','_locations.*')
            ->join('_locations','_locations.id','=','notifications.id_loca')
            ->where('notifications.id_user', '=', $id)
            ->where('notifications.lue', '=', "non")
            ->whereRaw('DATEDIFF(NOW(), _locations.date_fin_loc) <= 7')
            ->whereRaw('DATEDIFF(NOW(), _locations.date_fin_loc) >= 0')
            ->get();    
        }
        else $notifications=NULL;
      
    $client= DB::table('users')
    ->where('users.id', '=', "$id_user")
    ->select('users.*')
    ->first();
    $partenaire= DB::table('_avis')
    ->join('users AS partenaire', 'partenaire.id', '=', '_avis.id_profile')
    ->join('_locations', '_locations.id_client', '=', '_avis.user_id')
    ->where('_avis.user_id', '=', "$id_user")
    ->select('partenaire.*', '_avis.*')
    ->get();
  //  dd($partenaire);

    return view('profil',['partenaire'=>$partenaire,'client'=>$client,'notifications'=>$notifications]);



    }

}
   

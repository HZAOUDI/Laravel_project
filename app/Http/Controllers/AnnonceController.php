<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Models\Annonce;
use App\Models\Objet;
use App\Models\dispo;
use App\Models\Categorie;
use Illuminate\Support\Facades\Mail;
class AnnonceController extends Controller
{
    public static function index(){
        $id = auth()->user()->id;
        $objets = Objet::where('user_id',$id)->get();
        $categories = Categorie::all();
        if (Auth::check()) {
            $notifications = DB::table('notifications')
            ->select('notifications.*','_locations.date_fin_loc')
            ->join('_locations','_locations.id','=','notifications.id_loca')
            ->where('notifications.id_user', '=', $id)
            ->get();  
            return view('add')->with(['objets'=>$objets,'categories'=>$categories,'notifications'=>$notifications]);
            }
            else $notifications=NULL;
        
        return view('add')->with(['objets'=>$objets,'categories'=>$categories]);
    }
    public static function store(Request $request){
        $id_objet = request('objet');
        $objet = Objet::where('id',$id_objet)->first();
        $annonce = new annonce();
        $annonce->Nom = request('Nom');
        $annonce->Description = request('Description');
        $annonce->objet = $objet->id;
        $annonce->Marque = $objet->Marque;
        $annonce->image = $objet->image;
        $annonce->Prix = request('Prix');
        $annonce->status = "disponible";
        $annonce->Categorie = $objet->Categorie;
        $annonce->Ville = request('Ville');
        $annonce->type = request('type');
        //////////////////////////////////////////////////////
        if(request('type')==="Normale"){
            $annonce->Num_jour_min = request('Num_jour_min');
                $date1 = request('date_dispo_debut');
                $date2 = request('date_dispo_fin');
                $difference = strtotime($date2) - strtotime($date1);
                $days = abs($difference/(60 * 60)/24);
                if($date1<$date2){
                    if($days>=$annonce->Num_jour_min){
                        $annonce->date_dispo_debut = request('date_dispo_debut');
                        $annonce->date_dispo_fin = request('date_dispo_fin');
                        $annonce->is_visible = "1";
                        $annonce->user_id = auth()->user()->id ;
                        $annonce->save();

                    return redirect('/');
                }
                else{
                    $msg1 = "error dans le nombre du jour";
                    return redirect('/add_ann')->with('message', '!!!ERROR DANS LE NOMBRE DU JOUR');}
            }
                else {
                    $msg1 = "error dans la date";
                    return redirect('/add_ann')->with('message', '!!!ERROR DANS LA DATE');
                }
        }
        //////////////////////////////////////////////////////
        else{
            //redirect("/".request('type'));
            $dispo = new dispo();
             // could generate an error
             $selectedDays = $request->disponibilite;
             $selectedMonths = $request->month;
            $binaryString = '';
            $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            foreach ($daysOfWeek as $day) {
                if (in_array($day, $selectedDays)) {
                    $binaryString .= '1';
                } else {
                    $binaryString .= '0';
                }
            }
            $binaryString2 = '';
            $Months = ["janvier",
            "février",
            "mars",
            "avril",
            "mai",
            "juin",
            "juillet",
            "août",
            "septembre",
            "octobre",
            "novembre",
            "décembre"];
            foreach ($Months as $Month) {
                if (in_array($Month, $selectedMonths)) {
                    $binaryString2 .= '1';
                } else {
                    $binaryString2 .= '0';
                }
            }
            $dispo->disponibilité = $binaryString;
            $dispo->month = $binaryString2;
            $annonce->is_visible = "0";
            $annonce->user_id = auth()->user()->id ;
            $annonce->date_dispo_debut = request('date_dispo_debut2');
            $annonce->date_dispo_fin = request('date_dispo_fin2');
            $annonce->save();
            $dispo->annonce_id = $annonce->id;
            $dispo->save();
            return redirect("/"); 
    }
    }
    public function show(annonce $annonce)
    {
        if (Auth::check()) {
            $id = auth()->user()->id;
            $notifications = DB::table('notifications')
            ->select('notifications.*','_locations.date_fin_loc')
            ->join('_locations','_locations.id','=','notifications.id_loca')
            ->where('notifications.id_user', '=', $id)
            ->get();  
        }
        else $notifications=NULL;
        return view('show')->with(['annonce'=>$annonce,'notifications'=>$notifications]);
        
    }
    public function edit(annonce $annonce)
    {
        if (Auth::check()) {
            $id = auth()->user()->id;
            $user = auth()->user();
            $notifications = DB::table('notifications')
            ->select('notifications.*','_locations.date_fin_loc')
            ->join('_locations','_locations.id','=','notifications.id_loca')
            ->where('notifications.id_user', '=', $id)
            ->get();  
        }
        else $notifications=NULL;
        return view('edit',compact('annonce','notifications','user'));
    }
    
    public function update(Request $request, annonce $annonce)
    {
        $request->validate([
            'Nom' => '',
            'Description' => '',
            'Ville'=> '',
            'is_visible'=> '',
            'status'=> '',
            'type'=> '',
            'date_dispo_debut'=> '',
            'date_dispo_fin'=> '',
            'Num_jour_min'=> '',
        ]);
   
        $input = $request->all();
   
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
           
        $annonce->update($input);
     
        return redirect("/")
                        ->with('success','Product updated successfully');
    }
    public function update2(Request $request,annonce $annonce){
        $annonce->Nom = request('Nom');
        $annonce->Description = request('Description');
        $annonce->Ville = request('Ville');
        $annonce->is_visible=request('is_visible');
        $annonce->status = request('status');
        $annonce->type = request('type');
        ///
        $date1 = request('date_dispo_debut');
        $date2 = request('date_dispo_fin');
        $difference = strtotime($date2) - strtotime($date1);
        $days = abs($difference/(60 * 60)/24);
        if($date1<$date2){
            if($days>$annonce->Num_jour_min){
                $annonce->date_dispo_debut = request('date_dispo_debut');
                $annonce->date_dispo_fin = request('date_dispo_fin');
                $annonce->Num_jour_min = request('Num_jour_min');
                $annonce->save();
                return redirect('/')->with('success','Product updated successfully');
            }
        }
        ///
        return redirect('/')->with('success','Product not updated');
        
        
    }
    public function AfficherAnnonce(){
        $user = Auth::user();
        if (Auth::check()) {
        $Annonces = DB::table('annonces')
            ->where('annonces.is_visible', '=', "1")
            ->where('annonces.user_id', '!=', $user->id)
            ->get();  

        $scores = [];
            foreach ($Annonces as $annonce) {
                $score_moyen = DB::table('_avis')
                    ->where('id_annonce', '=', $annonce->id)
                    ->avg('score_objet');
                $scores[$annonce->id] = $score_moyen;
            }

        $notifications = DB::table('notifications')
                    ->select('notifications.*','_locations.*')
                    ->join('_locations','_locations.id','=','notifications.id_loca')
                    ->where('notifications.id_user', '=', $user->id)
                    ->where('notifications.lue', '=', "non")
                    //->whereRaw("DATEDIFF(date('Y-m-d'),_locations.date_fin_loc) >= 0")
                    //  ->whereRaw("DATEDIFF(date('Y-m-d'),_locations.date_fin_loc) = ")
                    ->whereRaw('DATEDIFF(NOW(), _locations.date_fin_loc) <= 7')
                    ->get();                 
                    //dd($notifications);
        }
    

    else {
    $notifications=null;
    $Annonces = DB::table('annonces')
    ->where('annonces.is_visible', '=', "1")
    ->get();  

    $scores = [];
    foreach ($Annonces as $annonce) {
        $score_moyen = DB::table('_avis')
            ->where('id_annonce', '=', $annonce->id)
            ->avg('score_objet');
        $scores[$annonce->id] = $score_moyen;
    }

    }
                    
        return view('Acceuil',['notifications'=>$notifications,'Annonces'=>$Annonces,'scores' => $scores]);

        
    }

/////////////////THIS WAS MADE BY HAJAR//////////////////////////////////////
public function AfficherUneAnnonce($id){
    if (Auth::check()) {
        $notifications = DB::table('notifications')
        ->select('notifications.*','_locations.date_fin_loc')
        ->join('_locations','_locations.id','=','notifications.id_loca')
        ->where('notifications.id_user', '=', $id)
        ->get();  
        }
        else $notifications=NULL;

    $annonce = DB::table('annonces')
        ->where('annonces.id', '=', $id)
        ->get(); 
    $dispo = dispo::where('annonce_id',$id)->first(); //TO BE ADDEDDDDDDDDDDDDDDD
//  dd($annonce);
    $user2=DB::table('users')
    ->where('users.id', '=', $annonce[0]->user_id)
    ->get();  


    $nbr = DB::table('annonces')
    ->where('annonces.user_id', '=', $user2[0]->id)
    ->count(); 

    $score = DB::table('_avis')
    ->select(DB::raw('SUM(score_user) as score, COUNT(*) as count'))
    ->where('user_id', $user2[0]->id)
    ->first();
   if($score->count!=0)
    $score_user=$score->score/$score->count;
    else $score_user=0;
     $user = Auth::user();

     $scores = DB::table('_avis')
     ->join('annonces', '_avis.id_annonce', '=', 'annonces.id')
     ->where('annonces.id', '=', $id)
     ->pluck('score_objet');
 $score_objet = $scores->avg();

/* $avis = DB::table('_avis')
     ->join('annonces', '_avis.id_annonce', '=', 'annonces.id')
     ->join('_locations', '_locations.id', '=', '_avis.id_location')
     ->join('users', 'users.id', '=', '_locations.id_client')
     ->where('annonces.id', '=', $id)
     ->get();*/


     $commentaires_objet = DB::table('_avis')
     ->join('_locations', '_locations.id', '=', '_avis.id_location')
     ->join('users', 'users.id', '=', '_locations.id_client')
     ->join('annonces', 'annonces.id', '=', '_avis.id_annonce')
     ->where('annonces.id', '=', $id)
     ->select('users.nom', '_avis.description_objet')
     ->get();
     $commentaires_partenaire = DB::table('_avis')
 ->join('_locations', '_locations.id', '=', '_avis.id_location')
 ->join('users', 'users.id', '=', '_locations.id_client')
 ->join('annonces', 'annonces.id', '=', '_avis.id_annonce')
 ->where('annonces.id', '=', $id)
 ->select('users.nom', '_avis.description_user')
 ->get();

 $commentaires = DB::table('_avis')
 ->join('_locations', '_locations.id', '=', '_avis.id_location')
 ->join('users', 'users.id', '=', '_locations.id_client')
 ->join('annonces', 'annonces.id', '=', '_avis.id_annonce')
 ->where('annonces.id', '=', $id)
 ->select('_avis.*','users.*')
 ->get();

// dd($commentaires);




$total_commentaires_objet = $commentaires_objet->count();
$total_commentaires_partenaire = $commentaires_partenaire->count();
$total_commentaires = $total_commentaires_objet + $total_commentaires_objet ;
 $scores_objet = DB::table('_avis')
     ->join('annonces', '_avis.id_annonce', '=', 'annonces.id')
     ->where('annonces.id', '=', $id)
     ->pluck('score_objet');

 $scores_objets = DB::table('_avis')
     ->join('_locations', '_locations.id', '=', '_avis.id_location')
     ->join('users', 'users.id', '=', '_locations.id_client')
     ->join('annonces', 'annonces.id', '=', '_avis.id_annonce')
     ->where('annonces.id', '=', $id)
     ->select('users.nom', '_avis.score_objet')
     ->get();

     $scores_utilisateurs = DB::table('_avis')
     ->join('_locations', '_locations.id', '=', '_avis.id_location')
     ->join('users', 'users.id', '=', '_locations.id_client')
     ->join('annonces', 'annonces.id', '=', '_avis.id_annonce')
     ->where('annonces.id', '=', $id)
     ->select('users.nom', '_avis.score_user')
     ->get(); 
     
     if (Auth::check()) {
     $AnnoncesSimilaires = DB::table('annonces')
     ->where('annonces.id', '!=', $annonce[0]->id)
     ->where('annonces.is_visible', '=', "1")
     ->where('annonces.user_id', '!=', $user->id)
     ->where('annonces.Categorie', '=',  $annonce[0]->Categorie)
     ->where('annonces.status','=','disponible')
     ->take(4)
     ->get(); 

     

     $notifications = DB::table('notifications')
     ->select('notifications.*','_locations.date_fin_loc')
     ->join('_locations','_locations.id','=','notifications.id_loca')
     ->where('notifications.id_user', '=', $user->id)
     ->get();  
     
     }
     else{
     $AnnoncesSimilaires=NULL;
     $notifications=NULL;
     
    }
  
      return view('Annonce', ['annonce' => $annonce, 'annonceSimilaire' => $AnnoncesSimilaires,'notifications'=>$notifications,'user2'=>$user2,'nbr'=>$nbr,'score'=>$score_user  ,'commentaires_objet'=>$commentaires_objet,
      'commentaires_partenaire'=>$commentaires_partenaire,
      'total_commentaires_objet' => $total_commentaires_objet,
      'total_commentaires_partenaire' => $total_commentaires_partenaire,
      'total_commentaires' => $total_commentaires,
  'score_objet' => $score_objet,
  'scores_objets' => $scores_objets,
  'scores_utilisateurs' => $scores_utilisateurs,
'commentaires'=>$commentaires,'dispo'=>$dispo]);

}

/*public function search(Request $request)
{
    $string = $request->categorie_ville;
    $headers = explode(',', $string);
    $cat = $headers[0];
    $ville = $headers[1];
    $order = $headers[2];
  //  $scoreOrder = $request->score_order;
    $string2 = $request->nomObjet;
    if ($string2 != '') {
        $produits = DB::table('annonces')
            ->where('annonces.Objet', 'LIKE', '%' . $string2 . '%')
            ->orWhere('annonces.Nom', 'LIKE', '%' . $string2 . '%')
            ->select('annonces.*')
            ->get();

        if (count($produits) > 0) {
            // Récupération des scores moyens pour chaque annonce
            $scores = [];
            foreach ($produits as $annonce) {
                $score_moyen = DB::table('_avis')
                    ->where('id_annonce', '=', $annonce->id)
                    ->avg('score_objet');
                $scores[$annonce->id] = $score_moyen;
            }

            return view('product', [
                'Annonces' => $produits,
                'scores' => $scores
            ]);
        } else {
            return "Aucune annonce n'est trouvée dans cette catégorie";
        }
    }

    if ($cat == 'tous' && $ville == 'tous') {
        $produits = DB::table('annonces')
            ->select('annonces.*')
            ->orderBy('Prix', $order)
           // ->orderBy('score_moyen', $scoreOrder)
            ->get();

        if (count($produits) > 0) {
            // Récupération des scores moyens pour chaque annonce
            $scores = [];
            foreach ($produits as $annonce) {
                $score_moyen = DB::table('_avis')
                    ->where('id_annonce', '=', $annonce->id)
                    ->avg('score_objet');
                $scores[$annonce->id] = $score_moyen;
            }

            return view('product', [
                'Annonces' => $produits,
                'scores' => $scores
            ]);
        } else {
            return "Aucune annonce n'est trouvée dans cette catégorie";
        }
    } else if ($cat == 'tous' && $ville != 'tous') {
        $produits = DB::table('annonces')
            ->select('annonces.*')
            ->where('annonces.Ville', $ville)
            ->orderBy('annonces.Prix', $order)
           // ->orderBy('score_moyen', $scoreOrder)
            ->get();

        if (count($produits) > 0) {
            // Récupération des scores moyens pour chaque
            $scores = [];
            foreach ($produits as $annonce) {
            $score_moyen = DB::table('_avis')
            ->where('id_annonce', '=', $annonce->id)
            ->avg('score_objet');
            $scores[$annonce->id] = $score_moyen;
            }
            return view('product', [
                'Annonces' => $produits,
                'scores' => $scores
            ]);
        } else {
            return "Aucune annonce n'est trouvée dans cette catégorie et cette ville";
        }
    } else if ($cat != 'tous' && $ville == 'tous') {
        $produits = DB::table('annonces')
            ->select('annonces.*')
            ->where('annonces.Categorie', $cat)
            ->orderBy('annonces.Prix', $order)
            //->orderBy('score_moyen', $scoreOrder)
            ->get();
    
        if (count($produits) > 0) {
            // Récupération des scores moyens pour chaque annonce
            $scores = [];
            foreach ($produits as $annonce) {
                $score_moyen = DB::table('_avis')
                    ->where('id_annonce', '=', $annonce->id)
                    ->avg('score_objet');
                $scores[$annonce->id] = $score_moyen;
            }
    
            return view('product', [
                'Annonces' => $produits,
                'scores' => $scores
            ]);
        } else {
            return "Aucune annonce n'est trouvée dans cette catégorie";
        }
    } else {
        $produits = DB::table('annonces')
            ->select('annonces.*')
            ->where('annonces.Categorie', $cat)
            ->where('annonces.Ville', $ville)
            ->orderBy('annonces.Prix', $order)
           // ->orderBy('score_moyen', $scoreOrder)
            ->get();
    
        if (count($produits) > 0) {
            // Récupération des scores moyens pour chaque annonce
            $scores = [];
            foreach ($produits as $annonce) {
                $score_moyen = DB::table('_avis')
                    ->where('id_annonce', '=', $annonce->id)
                    ->avg('score_objet');
                $scores[$annonce->id] = $score_moyen;
            }
            if (Auth::check()) {
                $id = auth()->user()->id;
                $notifications = DB::table('notifications')
                ->select('notifications.*','_locations.date_fin_loc')
                ->join('_locations','_locations.id','=','notifications.id_loca')
                ->where('notifications.id_user', '=', $id)
                ->get();  
            }
            else $notifications=NULL;
            return view('product', [
                'Annonces' => $produits,
                'scores' => $scores,
                'notifications' => $notifications
            ]);
        } else {
            return "Aucune annonce n'est trouvée dans cette catégorie et cette ville";
        }
    }
}*/

public function search(Request $request)
{
    $string = $request->categorie_ville;
    $headers = explode(',', $string);
    $cat = $headers[0];
    $ville = $headers[1];
    $order = $headers[2];
    $score_moy = $headers[3];
  


    
  
    $string2 = $request->nomObjet;
    if ($string2 != '') {
        $produits = DB::table('annonces')
            ->where('annonces.Objet', 'LIKE', '%' . $string2 . '%')
            ->orWhere('annonces.Nom', 'LIKE', '%' . $string2 . '%')
            ->select('annonces.*')
            ->get();

        if (count($produits) > 0) {
            
            // Récupération des scores moyens pour chaque annonce
            $scores = [];
            foreach ($produits as $annonce) {
                $score_moyen = DB::table('_avis')
                    ->where('id_annonce', '=', $annonce->id)
                    ->avg('score_objet');
                $scores[$annonce->id] = $score_moyen;
            }

            return view('product', [
                'Annonces' => $produits,
                'scores' => $scores
            ]);
        } else {
            return "Aucune annonce n'est trouvée dans cette catégorie";
        }
    }

    if ($cat == 'tous' && $ville == 'tous') {
        $produits = DB::table('annonces')
    ->leftJoin(DB::raw('(SELECT id_annonce, AVG(score_objet) AS score_moyen FROM _avis GROUP BY id_annonce) AS sub_avis'), 'sub_avis.id_annonce', '=', 'annonces.id')
    ->select('annonces.*', 'sub_avis.score_moyen')
    ->orderBy('Prix', $order)
    ->orderBy('sub_avis.score_moyen', $score_moy)
    ->get();


        if (count($produits) > 0) {
            // Récupération des scores moyens pour chaque annonce
            $scores = [];
            foreach ($produits as $annonce) {
                $score_moyen = DB::table('_avis')
                    ->where('id_annonce', '=', $annonce->id)
                    ->avg('score_objet');
                $scores[$annonce->id] = $score_moyen;
            }

            return view('product', [
                'Annonces' => $produits,
                'scores' => $scores
            ]);
        } else {
            return "Aucune annonce n'est trouvée dans cette catégorie";
        }
    } else if ($cat == 'tous' && $ville != 'tous') {
        $produits = DB::table('annonces')
        ->leftJoin(DB::raw('(SELECT id_annonce, AVG(score_objet) AS score_moyen FROM _avis GROUP BY id_annonce) AS sub_avis'), 'sub_avis.id_annonce', '=', 'annonces.id')
        ->select('annonces.*', 'sub_avis.score_moyen')
        ->where('annonces.Ville', $ville)
        ->orderBy('annonces.Prix', $order)
        ->orderBy('sub_avis.score_moyen', $score_moy)
        ->get();
    
        
        if (count($produits) > 0) {
            // Récupération des scores moyens pour chaque
            $scores = [];
            foreach ($produits as $annonce) {
            $score_moyen = DB::table('_avis')
            ->where('id_annonce', '=', $annonce->id)
            ->avg('score_objet');
            $scores[$annonce->id] = $score_moyen;
            }
            return view('product', [
                'Annonces' => $produits,
                'scores' => $scores
            ]);
        } else {
            return "Aucune annonce n'est trouvée dans cette catégorie et cette ville";
        }
    } else if ($cat != 'tous' && $ville == 'tous') {
        $produits = DB::table('annonces')
    ->leftJoin(DB::raw('(SELECT id_annonce, AVG(score_objet) AS score_moyen FROM _avis GROUP BY id_annonce) AS sub_avis'), 'sub_avis.id_annonce', '=', 'annonces.id')
    ->select('annonces.*', 'sub_avis.score_moyen')
    ->where('annonces.Categorie', $cat)
    ->orderBy('annonces.Prix', $order)
    ->orderBy('sub_avis.score_moyen', $score_moy)
    ->get();

         
    
    
        if (count($produits) > 0) {
            // Récupération des scores moyens pour chaque annonce
            $scores = [];
            foreach ($produits as $annonce) {
                $score_moyen = DB::table('_avis')
                    ->where('id_annonce', '=', $annonce->id)
                    ->avg('score_objet');
                $scores[$annonce->id] = $score_moyen;
            }
    
            return view('product', [
                'Annonces' => $produits,
                'scores' => $scores
            ]);
        } else {
            return "Aucune annonce n'est trouvée dans cette catégorie";
        }
    } else {
       
           $produits = DB::table('annonces')
    ->leftJoin(DB::raw('(SELECT id_annonce, AVG(score_objet) AS score_moyen FROM _avis GROUP BY id_annonce) AS sub_avis'), 'sub_avis.id_annonce', '=', 'annonces.id')
    ->select('annonces.*', 'sub_avis.score_moyen')
    ->where('annonces.Categorie', $cat)
    ->where('annonces.Ville', $ville)
    ->orderBy('annonces.Prix', $order)
    ->orderBy('sub_avis.score_moyen', $score_moy)
    ->get();

    
    
        if (count($produits) > 0) {
            // Récupération des scores moyens pour chaque annonce
            $scores = [];
            foreach ($produits as $annonce) {
                $score_moyen = DB::table('_avis')
                    ->where('id_annonce', '=', $annonce->id)
                    ->avg('score_objet');
                $scores[$annonce->id] = $score_moyen;
            }
            if (Auth::check()) {
                $id = auth()->user()->id;
                $notifications = DB::table('notifications')
                ->select('notifications.*','_locations.date_fin_loc')
                ->join('_locations','_locations.id','=','notifications.id_loca')
                ->where('notifications.id_user', '=', $id)
                ->get();  
            }
            else $notifications=NULL;
            return view('product', [
                'Annonces' => $produits,
                'scores' => $scores,
                'notifications' => $notifications
            ]);
        } else {
            return "Aucune annonce n'est trouvée dans cette catégorie et cette ville";
        }
    }
}







    public static function consulter(){
        if (Auth::check()) {
            $id = auth()->user()->id;
            $notifications = DB::table('notifications')
            ->select('notifications.*','_locations.date_fin_loc')
            ->join('_locations','_locations.id','=','notifications.id_loca')
            ->where('notifications.id_user', '=', $id)
            ->get();  
        }
        else $notifications=NULL;
        $id = auth()->user()->id;
        $annonces = annonce::where('user_id',$id)->get();
        $idann = 0;
        return view('index',['products' => $annonces,
    'id'=>$idann,'notifications'=>$notifications]);
    }
    public static function Sendmail(){
        $body1 = "test body 122";
        //Client Email
        Mail::send([], [], function ($message) {
            $message->to('aymane.matrane@etu.uae.ac.ma')
                    ->subject('Information sur le partenaire')
                    ->setBody('Example Body', 'text/plain');
        });
        //Partenaire Email
        Mail::send([], [], function ($message) use ($body1) {
            $message->to('aymane.matrane@etu.uae.ac.ma')
                    ->subject('Information sur le client')
                    ->setBody($body1, 'text/plain');
        });
        return redirect('/');
    }
    public function editAnnonce(Annonce $product)
    {
        $id = auth()->user()->id;
        $notifications = DB::table('notifications')
            ->select('notifications.*','_locations.date_fin_loc')
            ->join('_locations','_locations.id','=','notifications.id_loca')
            ->where('notifications.id_user', '=', $id)
            ->get();
        return view('edit')->with(['product'=>$product, 'notifications'=>$notifications]);
       
    }
    

    public function destroy(Annonce $product)
    {
        $product->delete();
      
        return redirect('/consulter')
                        ->with('success','Annonce deleted successfully');
    }
    }
    
<?php
namespace App\Http\Controllers;
use App\Models\Location;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Contrat;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Annonce;

// Disable SSL verification temporarily
stream_context_set_default(
    array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
      ),
    )
  );

class LocationController extends Controller
{
    public function demandesDeReservation()
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
        $userId = auth()->id();
        $locations = DB::table('_locations')
                    ->where('id_part', $userId)
                    ->orWhere('id_client', $userId)
                    ->get();

        return view('demandes-de-reservation', ['_locations' => $locations,'notifications' =>$notifications]);
    }

   /* public function confirm($location_id){
        $location = Location::findOrFail($location_id);
        $location->status = 'confirmé';
        $location->save();

       
        $contrat = new Contrat();
        $contrat->filename = Str::random(10); 
        $contrat->id_partenaire = $location->id_part;
        $contrat->id_client = $location->id_client;
        $contrat->id_ann = $location->id_annonce;
        $contrat->save();

        return redirect()->back();
    }*/
    public function confirm($location_id)
{
    $location = Location::findOrFail($location_id);
    $location->status = 'confirmé';
    $location->save();
    

    $contrat = new Contrat();
    $contrat->filename = Str::random(10); 
    $contrat->id_partenaire = $location->id_part;
    $contrat->id_client = $location->id_client;
    $contrat->id_ann = $location->id_annonce;
    $contrat->save();

    $client = User::findOrfail($location->id_client);
    $partenaire = User::findOrfail($location->id_part);
    $data1['email'] = $client->email;
    $data1['body'] = "Le partenaire de l annonce a les informations suivantes: \r\n"
                ."Nom: ".$partenaire->nom.". \r\n"
                ."Prenom: ".$partenaire->prenom.". \r\n"
                ."Email: ".$partenaire->email.". \r\n"
                ."Telephone: ".$partenaire->telephone.". \r\n"
                ."Adresse: ".$partenaire->adresse.". \r\n"
                ."RentApp Team";
    $data2['body'] = "Le client a les informations suivantes: \r\n"
                ."Nom: ".$client->nom.". \r\n"
                ."Prenom: ".$client->prenom.". \r\n"
                ."Email: ".$client->email.". \r\n"
                ."Telephone: ".$client->telephone.". \r\n"
                ."Adresse: ".$client->adresse.". \r\n"
                ."RentApp Team";
    $data2['email'] = $partenaire->email;
    

       
        Mail::send([], $data1, function ($message) use ($data1) {
            $message->to($data1["email"])
                ->subject('Information sur le partenaire')
                ->setBody($data1['body'], 'text/plain');
        });
        //Partenaire Email
        Mail::send([], $data2, function ($message) use ($data2) {
            $message->to($data2["email"])
                ->subject('Information sur le client')
                ->setBody($data2['body'], 'text/plain');
        });

        $notification = new Notification();
        $notification->contenu="Veuillez verifier votre boite email";
        $notification->type="1";
        $notification->lue="non";
        $notification->id_user = $partenaire->id;
        $notification->save();
        $notification = new Notification();
        $notification->contenu="Veuillez verifier votre boite email";
        $notification->type="1";
        $notification->lue="non";
        $notification->id_user = $client->id;
        $notification->save();
    //////////////////////////////

    return redirect()->back();
}



public function refuse($location_id)
{
    $location = Location::findOrFail($location_id);
    $location->status = 'refusé';
    $location->save();

    if(auth()->id() == $location->id_part) { // Vérifie que l'utilisateur connecté est bien le partenaire
        $annonce = Annonce::findOrFail($location->id_annonce);
        $annonce->is_visible = 1; // Modifie la valeur de la colonne is_visible à 1
        $annonce->save();
    }

    return redirect()->back();
}
}
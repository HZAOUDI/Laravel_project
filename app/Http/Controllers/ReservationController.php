<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // ajout de cette ligne pour importer la classe DB
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Annonce;
use App\Models\Notification;
use Carbon\Carbon;



class ReservationController extends Controller
{
    public function store(Request $request)
{
    $id_annonce = $request->annonce_id;
    $annonce = Annonce::find($request->annonce_id);

    // Vérifier si l'utilisateur a déjà une location en cours pour cette annonce
    $existingLocation = Location::where('id_client', Auth::user()->id)
        ->where('id_annonce', $request->annonce_id)
        ->where('status', 'en attente')
        ->first();

    if ($existingLocation) {
        return redirect()->back()->withErrors(['error' => 'Vous avez déjà une réservation en attente pour cette annonce']);
    }

    // Vérifier si l'annonce est disponible
    if ($annonce->status == "non disponible") {
        return redirect()->back()->withErrors(['error' => 'Désolé, cette annonce n\'est plus disponible']);
    }

    if ($annonce->type == 'Normale') {
        // Valider les informations de réservation soumises dans le formulaire
        $validatedData = $request->validate([
            'date_debut_loc' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($annonce) {
                    if ($value < $annonce->date_dispo_debut || $value > $annonce->date_dispo_fin) {
                        $fail('La date de début de la réservation doit être incluse dans la période de disponibilité de l\'annonce.');
                    }
                }
            ],
            'date_fin_loc' => [
                'required',
                'date',
                'after:date_debut_loc',
                function ($attribute, $value, $fail) use ($annonce) {
                    if ($value < $annonce->date_dispo_debut || $value > $annonce->date_dispo_fin) {
                        $fail('La date de fin de la réservation doit être incluse dans la période de disponibilité de l\'annonce.');
                    }
                }
            ],
        ]);

          // Calculer le nombre de jours de location
    $dateDebut = Carbon::parse($validatedData['date_debut_loc']);
    $dateFin = Carbon::parse($validatedData['date_fin_loc']);
    $nombreDeJours = $dateDebut->diffInDays($dateFin);

    // Vérifier si le nombre de jours est inférieur au nombre minimum de jours de réservation
    $numJourMin = $annonce->Num_jour_min ; // Récupérer le nombre minimum de jours de réservation pour l'annonce, ou 1 par défaut
    if ($nombreDeJours < $numJourMin) {
        return redirect()->back()->withErrors(['error' => "Vous devez réserver pour au moins $numJourMin jours."]);
    }

        // Créer une nouvelle instance de location et la remplir avec les données soumises dans le formulaire
        $location = Location::create([
            'date_debut_loc' => $validatedData['date_debut_loc'],
            'date_fin_loc' => $validatedData['date_fin_loc'],
            'id_client' => Auth::user()->id,
            'id_annonce' => $id_annonce,
            'id_part' => $request->partenaire_id,
            'status' => 'en attente',
        ]);
    }

    if ($annonce->type == 'Particuliere') {
        // Valider les informations de réservation soumises dans le formulaire
        $validatedData = $request->validate([
            'date_debut_loc' => 'required|date',
            'date_fin_loc' => 'required|date|after:date_debut_loc',
            'jours' => 'required|array',
            'jours.*' => 'string',
            'month' => 'required|array',
            'month.*' => 'string',
        ]);


            // Vérifier les dates de location par rapport aux dates de disponibilité
    $dispoDebut = Carbon::parse($annonce->date_dispo_debut);
    $dispoFin = Carbon::parse($annonce->date_dispo_fin);
    $locationDebut = Carbon::parse($validatedData['date_debut_loc']);
    $locationFin = Carbon::parse($validatedData['date_fin_loc']);
    if ($locationDebut->lt($dispoDebut) || $locationDebut->gt($dispoFin) ||
        $locationFin->lt($dispoDebut) || $locationFin->gt($dispoFin)) {
        return back()->withInput()->withErrors(['date_debut_loc' => 'La période de location ne respecte pas les dates de disponibilité.']);
    }

        // Créer une nouvelle instance de location pour chaque paire de dates
        foreach ($validatedData['jours'] as $index => $jour) {
            $location = Location::create([
                'date_debut_loc' => $validatedData['date_debut_loc'],
                'date_fin_loc' => $validatedData['date_fin_loc'],
                'id_client' => Auth::user()->id,
                'id_annonce' => $id_annonce,
                'id_part' => $request->partenaire_id,
                'status' => 'en attente',
                'Jours' => $jour,
                'Mois' => $validatedData['month'][$index],
            ]);
        }
    }

    // Mettre à jour le statut de l'annonce
    DB::table('annonces')
        ->where('id', $id_annonce)
        ->update(['status' => 'non disponible']);

         // Mettre à jour le statut de visibilité de l'annonce
    $annonce->is_visible = 0; // Mettez la valeur appropriée ici (1 ou 0)
    $annonce->save();
////////////:ajout de la notifications ///////////

$id_location = DB::table('_locations')
   ->where('id_annonce', '=', "$id_annonce")
   ->orderByDesc('created_at')
   ->limit(1)
   ->select('_locations.*')
   ->get();  
   $notification = new Notification();
   $notification->contenu="Veuillez donner votre avis à propos de votre client";
   $notification->type="2";
   $notification->lue="non";
   $notification->id_user = $id_location[0]->id_part;
   $notification->id_ann = $id_annonce;
   $notification->id_loca= $id_location[0]->id;
   $notification->save();
   $notification = new Notification();
   $notification->contenu="Veuillez donner votre avis à propos du partenaire";
   $notification->type="3";
   $notification->lue="non";
   $notification->id_user = $id_location[0]->id_client;
   $notification->id_ann = $id_annonce;
   $notification->id_loca= $id_location[0]->id;
   $notification->save();


//////////////////////////////////////////////////
    // Rediriger l'utilisateur vers la page de confirmation de réservation
    return redirect()->back()->with('success', 'Votre réservation a été enregistrée avec succès.');
}
}

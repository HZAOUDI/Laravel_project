<?php

namespace App\Http\Controllers\Annonce;

use App\Models\Annonce;
use App\Models\Categorie;
use App\Models\Objet;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Annonce\AnnonceFormRequest;

class AnnonceController extends Controller
{
    
    public function index(){
        $user_id = Auth::id(); 
        $annonces = Annonce::where('user_id', $user_id)->get(); 
        return view ('annonce.annonce.index', compact('annonces'));
    }
    

    public function create(){
        $categorie = Categorie::get();

        $user_id = Auth::id();
        $objet = Objet::where('user_id', $user_id)->get();

        return view ('annonce.annonce.create', compact('categorie', 'objet'));
    }

    public function store(AnnonceFormRequest $request){
        $data = $request->validated();
        $annonce = new Annonce;
        $annonce->Nom = $data['Nom'];
        $annonce->Description = $data['Description'];
        $annonce->Categorie = $data['Categorie'];
        $annonce->Objet = $data['Objet'];
        $annonce->Prix = $data['Prix'];
        $annonce->Num_jour_min = $data['Num_jour_min'];
        $annonce->Ville = $data['Ville'];
        $annonce->type = $data['type'];
        $annonce->date_dispo_debut = $data['date_dispo_debut'];
        $annonce->date_dispo_fin = $data['date_dispo_fin'];
        $annonce->is_visible = !empty($request->input('is_visible')) ? 1 : 0;
       $annonce->user_id = Auth::user()->id;

       $annonce->status = "disponible";
        $annonce->save();

        return redirect('annonces')->with('message','Annonce added successfully');
    }

    public function edit($annonce_id){
        $categorie = Categorie::get();
        $annonce = Annonce::find($annonce_id);
        
        $user_id = Auth::id();
        $objet = Objet::where('user_id', $user_id)->get();

        return view('annonce.annonce.edit', compact('annonce', 'categorie', 'objet'));
    }

    public function update(AnnonceFormRequest $request, $annonce_id){

        $data = $request->validated();
    
        $user_id = Auth::id();
        $num_checked = Annonce::where('user_id', $user_id)->where('is_visible', true)->count();

        if ($request->input('is_visible') && $num_checked >= 5) {
            return back()->withErrors(['is_visible' => 'You have already checked the maximum number of visible annonces.']);
        }

        
        $annonce = Annonce::find($annonce_id);

        $annonce->Nom = $data['Nom'];
        $annonce->Description = $data['Description'];
        $annonce->Categorie = $data['Categorie'];
        $annonce->Objet = $data['Objet'];
        $annonce->Prix = $data['Prix'];
        $annonce->Num_jour_min = $data['Num_jour_min'];
        $annonce->Ville = $data['Ville'];
        $annonce->type = $data['type'];
        $annonce->date_dispo_debut = $data['date_dispo_debut'];
        $annonce->date_dispo_fin = $data['date_dispo_fin'];
        $annonce->is_visible = !empty($request->input('is_visible')) ? 1 : 0;
        $annonce->user_id = Auth::user()->id;

        $annonce->update();

        return redirect('annonces')->with('message','Annonce modifier successfully');
    }

    public function destroy($annonce_id){
        $annonce = Annonce::find($annonce_id);
        $annonce->delete();
        return redirect('annonces')->with('message','Annonce supprime successfully');
    }
    
}

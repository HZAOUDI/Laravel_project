<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Annonce;

use App\Http\Requests\Admin\AnnonceFormRequest;

class AnnonceController extends Controller
{
    public function index(){
        $annonces = Annonce::all();
        return view('admin.annonce.index', compact('annonces'));
    }
    
    public function create(){
        $category = Categorie::get();
        return view('admin.annonce.create', compact('category'));
    }

    public function store(AnnonceFormRequest $request){
        $data = $request->validated();

        $post = new Annonce;
        $annonce->image = $data['image'];
        $annonce->Nom = $data['Nom'];
        $annonce->Description = $data['Description'];
        $annonce->Marque = $data['Marque'];
        $annonce->Categorie = $data['Categorie'];
        $annonce->Categorie = $data['Objet'];
        $annonce->Prix = $data['Prix'];

        $annonce->Num_jour_min = $data['Num_jour_min'];
        $annonce->Ville = $data['Ville'];
        $annonce->date_dispo_debut = $data['date_dispo_debut'];
        $annonce->date_dispo_fin = $data['date_dispo_fin'];
        $annonce->status = $request->status == true ? '1' : '0';

        $annonce->save();
        return redirect('admin/annonces')->with('message', 'Annonce Added Succesffully');

    }

    public function edit($annonce_id){
        $category = Categorie::all();
        $annonce = Annonce::find($annonce_id);
        return view('admin.annonce.edit', compact('annonce', 'category'));

    }

    public function update(AnnonceFormRequest $request, $annonce_id){
        $data = $request->validated();

        $post =  Annonce::find($annonce_id);
        $annonce->image = $data['image'];
        $annonce->Nom = $data['Nom'];
        $annonce->Description = $data['Description'];
        $annonce->Marque = $data['Marque'];
        $annonce->Categorie = $data['Categorie'];
        $annonce->Categorie = $data['Objet'];
        $annonce->Prix = $data['Prix'];

        $annonce->Num_jour_min = $data['Num_jour_min'];
        $annonce->Ville = $data['Ville'];
        $annonce->date_dispo_debut = $data['date_dispo_debut'];
        $annonce->date_dispo_fin = $data['date_dispo_fin'];
        $annonce->status = $request->status == true ? '1' : '0';

        $annonce->update();
        return redirect('admin/annonces')->with('message', 'Annonce updated Succesffully');

    }

    public function destroy($annonce_id){
        $annonce = Annonce::find($annonce_id);
        $annonce->delete();
        return redirect('admin/annonces')->with('message', 'Annonce deleted Succesffully');

    }

}

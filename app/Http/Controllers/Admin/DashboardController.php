<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Categorie;
use App\Models\Annonce;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){

        $data = User::select('id','created_at')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });

        $categories = Categorie::count();
        $categoriesData = Categorie::all(); // Récupérer les données de la table "categories"
        $categoryLabels = [];
        $categoryCounts = [];
        foreach($categoriesData as $category ){
            $categoryLabels[] = $category->nom_cat; // Utiliser le nom de la catégorie comme étiquette
            $categoryCounts[] = $category->count; // Utiliser le nombre de catégories comme donnée
        }

        $data2 = Annonce::select('id','created_at')->get()->groupBy(function($data2){
            return Carbon::parse($data2->created_at)->format('M');
        });
        $months2=[];
        $mothCount2=[];
        foreach($data2 as $month2 => $values2){
            $months2[]=$month2;
            $mothCount2[]=count($values2);
        }
    

        $users = User::where('role_as', '0')->count();
        $admins = User::where('role_as' ,  '1')->count();

        $months=[];
        $mothCount=[];
        foreach($data as $month => $values){
            $months[]=$month;
            $mothCount[]=count($values);
        }


        return view ('admin.dashboard', compact('categories', 'categoryLabels', 'categoryCounts', 'users', 'admins', 'data', 'months','mothCount', 'months2','mothCount2'));
    
    }
}

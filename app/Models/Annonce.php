<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Categorie;

class Annonce extends Model
{
    use HasFactory;
    
    protected $table = 'annonces';
    protected $fillable = [
        
        'image',		
        'Nom',	
        'Description',	
        'Marque',	
        'Categorie',	
        'Objet',	
        'Prix',	
        'Num_jour_min',	
        'Ville',	
        'date_dispo_debut',	
        'date_dispo_fin',	
        'status',	
        'type',	
        'is_visible',	
        'user_id'	

    ];

    public function category(){
        return $this->belongsTo(Categorie::class, 'Categorie', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{
    use HasFactory;
    protected $table = 'objets';
    protected $fillable = [
        
        'Nom',	
        'Categorie',	
        'image',	
        'user_id'

    ];
}

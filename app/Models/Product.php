<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Product extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'nomAnnonce', 'description', 'Ville', 'is_visible', 'status', 'type', 'date_dispo_debut', 'date_dispo_fin', 'nbrJourMinLocation', 'image'
    ];
}
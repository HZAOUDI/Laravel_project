<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    protected $table = '_contrats';
    protected $fillable = [
        'filename',
        'id_partenaire',
        'id_client',
        'id_ann'
    ];

   
}

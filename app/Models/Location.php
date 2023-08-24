<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Annonce;

class Location extends Model
{
    protected $table = '_locations';

    protected $fillable = ['date_debut_loc', 'date_fin_loc','id_part', 'id_client','Jours','Mois', 'id_annonce', 'status'];



    public function annonce()
{
    return $this->belongsTo(Annonce::class, 'id_annonce');
}
}

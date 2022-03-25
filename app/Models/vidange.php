<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vidange extends Model
{
    use HasFactory;
    protected $fillable = [
        'auto_ecole_id',
        'montant',
        'etat',
        'date_vidange',
        'date_prochain_vidange',
        'image',
        'employe_id',
        'vehicule_id',
        'fournisseur_id',
    ];

}

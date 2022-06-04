<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vidange extends Model
{
    use HasFactory, SoftDeletes;
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

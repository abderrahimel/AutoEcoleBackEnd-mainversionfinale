<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Controle extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'employe_id',
        'etat_voiture',
        'fournisseur_id',
        'vehicule_id',
        'date_vidange',
        'date_suivante',
        'duree_remembring',
        'km_actuelle',
        'type_huile',
        'last_km',
        'ht',
        'taux',
        'ttc',
        'tva',
        'description',
        'filter',
        'type'
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}

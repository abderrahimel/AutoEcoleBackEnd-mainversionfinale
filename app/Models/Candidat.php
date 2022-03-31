<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'auto_ecole_id',
        'cin',
        'date_inscription',
        'numero_contrat',
        'ref_web',
        'nom_fr',
        'prenom_fr',
        'nom_ar',
        'prenom_ar',
        'date_naissance',
        'lieu_naissance',
        'adresse_fr',
        'adresse_ar',
        'telephone',
        'email',
        'type_formation',
        'profession',
        'langue',
        'image',
        'date_fin_contrat',
        'categorie_demandee',
        'nbr_heure_pratique',
        'nbr_heure_theorique',
        'possede_permis',
        'date_obtention',
        'lieu_obtention_fr',
        'lieu_obtention_ar',
        'montant',
        'pcn',
        'categorie',
        'observations',
        'actif',
        'moniteur_theorique_id',
        'moniteur_pratique_id',
        'vehicule_id',
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function moniteurPratique()
    {
        return $this->belongsTo(MoniteurPratique::class);
    }

    public function moniteurTheorique()
    {
        return $this->belongsTo(MoniteurTheorique::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    public function examens()
    {
        return $this->hasMany(Examen::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function dossiers()
    {
        return $this->hasOne(Dossier::class);
    }
}

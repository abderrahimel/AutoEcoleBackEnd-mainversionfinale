<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'matricule',
        'nom',
        'prenom',
        'photo',
        'CIN',
        'lieu_naissance',
        'date_naissance',
        'nationalité',
        'telephone', 
        'email',
        'date_insc',
        'permis',
        'connaissance',
        'adresse',
        'num_dossier',
        'langue',
        'type',
        'moniteur_theorique_id',
        'moniteur_pratique_id',
        'vehicule_id',
        'nbr_theo',  
        'nbr_pra',
        'frais_insc',
        'frais_heure',
        'date_dossier',  
        'frais_examen',  
        'avance',  
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

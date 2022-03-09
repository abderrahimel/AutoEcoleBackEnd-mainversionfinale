<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoEcole extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'etat',
        'nom_auto_ecole',
        'telephone',
        'pays',
        'ville',
        'fax',
        'site_web',
        'adresse',
        'image',
        'image_rc',
        'image_cin',
        'image_agrement',
        'ice',
        'tva',
        'n_register_de_commerce',
        'n_compte_bancaire',
        'n_agrement',
        'n_patente',
        'date_autorisation',
        'date_ouverture',
        'identification_fiscale',
        'cin_responsable',
        'nom_responsable',
        'prenom_responsable',
        'tel_responsable',
        'adresse_responsable',
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }

    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }

    public function employes()
    {
        return $this->hasMany(Employe::class);
    }

    public function moniteurPratiques()
    {
        return $this->hasMany(MoniteurPratique::class);
    }

    public function moniteurTheoriques()
    {
        return $this->hasMany(MoniteurTheorique::class);
    }

    public function courThoeriques()
    {
        return $this->hasMany(CourTheorique::class);
    }

    public function courPratiques()
    {
        return $this->hasMany(CourPratique::class);
    }

    public function CategorieDepence()
    {
        return $this->hasMany(CategorieDepence::class);
    }

    public function depences()
    {
        return $this->hasMany(Depence::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    public function recettes()
    {
        return $this->hasMany(Recette::class);
    }

    public function salaires()
    {
        return $this->hasMany(Salaire::class);
    }

    public function absences()
    {
        return $this->hasMany(Salaire::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function categoriePermis()
    {
        return $this->hasMany(CategoriePermis::class);
    }

    public function fournisseurs()
    {
        return $this->hasMany(Fournisseur::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function controles()
    {
        return $this->hasMany(Controle::class);
    }

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }

    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }

    public function examens()
    {
        return $this->hasMany(Examen::class);
    }

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
  
}

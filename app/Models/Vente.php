<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vente extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'auto_ecole_id',
        'candidat_id',
        'produit_id',
        'prixUnitaire',
        'prixTotale',
        'quantiteDisponible',
        'quantite',
        'date'
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}

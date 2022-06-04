<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'auto_ecole_id',
        'fournisseur',
        'telephone',
        'libelle',
        'prix',
        'quantite',
        'description',
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }


}

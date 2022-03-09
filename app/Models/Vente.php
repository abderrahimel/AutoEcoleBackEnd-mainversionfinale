<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'candidat_id',
        'date_vente',
        'produit',
        'prix',
        'quantite',
        'description'
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

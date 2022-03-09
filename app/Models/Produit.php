<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = [
        'auto_ecole_id',
        'nom',
        'date',
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

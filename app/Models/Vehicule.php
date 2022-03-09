<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'matricule',
        'type',
        'marque',
        'modele',
        'date_visite',
        'date_vidange',
        'carte_grise',
        'vignette',
        'assurance',
        'visite',     
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function candidat()
    {
        return $this->hasMany(Candidat::class);
    }

    public function courPratique()
    {
        return $this->hasMany(CourPratique::class);
    }

    public function controles()
    {
        return $this->hasMany(Controle::class);
    }
}

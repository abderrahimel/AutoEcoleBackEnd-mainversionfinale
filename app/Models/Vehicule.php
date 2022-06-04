<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'auto_ecole_id',
        'matricule',
        'type',
        'marque',
        'fourniseur',
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
    public function vidange()
    {
        return $this->belongsTo(Vidange::class);
    }
}

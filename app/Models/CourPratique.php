<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourPratique extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'moniteur_pratique_id',
        'jour',
        'nombre_place',
        'date_debut',
        'date_fin',
        'description',
        'vehicule_id'
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function moniteurPratique()
    {
        return $this->belongsTo(MoniteurPratique::class);
    }
    
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

}

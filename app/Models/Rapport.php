<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rapport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'auto_ecole_id',
        'date',
        'employe_id',
        'nombre_cours',
        'valeur_carburant',
        'km_aller',
        'km_retour',
        'description'
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}

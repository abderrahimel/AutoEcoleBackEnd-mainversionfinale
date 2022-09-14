<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbsencePratiqueMoniteur extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'auto_ecole_id',
        'moniteur_pratique_id',
        'type_absence',
        'date_debut',
        'date_fin',
        'remarque',
    ];
    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }
    public function moniteur(){
        return $this->belongsTo(MoniteurPratique::class);
    }
}

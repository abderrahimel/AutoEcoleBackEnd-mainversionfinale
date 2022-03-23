<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourTheorique extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'moniteur_theorique_id',
        'date',
        'date_debut',
        'date_fin',
        'permis',
        'type',
    ];
    
    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function moniteurTherique()
    {
        return $this->belongsTo(MoniteurTheorique::class);
    }
}

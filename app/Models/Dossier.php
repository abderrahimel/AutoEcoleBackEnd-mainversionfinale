<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dossier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'candidat_id',
        'CIN',
        'langue',
        'type',
        'moniteur_theorique_id',
        'moniteur_pratique_id',
        'prix',
        'prix_inscription',
        'heures_pratiques',
        'heures_theoriques',
        'date_dossier',
        'prix_examen',
        'avance',
    ];

    public function moniteurTheorique()
    {
        return $this->belongsTo(MoniteurTheorique::class);
    }

    public function moniteurPratique()
    {
        return $this->belongsTo(MoniteurTheorique::class);
    }

    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }

    
}

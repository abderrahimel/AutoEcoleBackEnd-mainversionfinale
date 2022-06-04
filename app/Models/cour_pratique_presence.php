<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class cour_pratique_presence extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'auto_ecole_id',
        'moniteur_pratique_id',
        'cour_pratique_id',
        'date',
        'heure_debut',
        'heure_fin',
        'categorie',
        'candidat',
        'presence',
    ];
    protected $casts = [
        'candidat' => 'array',
        'presence' => 'array'
    ];

    public function courPratique()
    {
        return $this->belongsTo(CourPratique::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cour_theorique_presence extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'auto_ecole_id',
        'moniteur_theorique_id',
        'cour_theorique_id',
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
   
    public function courTheorique()
    {
        return $this->hasOne(CourTheorique::class);
    }

}

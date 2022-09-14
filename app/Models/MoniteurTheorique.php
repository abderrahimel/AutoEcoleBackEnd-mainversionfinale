<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MoniteurTheorique extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'auto_ecole_id',
        'nom',
        'prenom',
        'cin',
        'type',
        'date_naissance',
        'lieu_naissance',
        'email',
        'telephone',
        'date_embauche',
        'capn',
        'conduire',
        'adresse',
        'observations',
        'categorie',
        'namecarteMoniteur'
    ];
    protected $casts = [
        'categorie' => 'array',
    ];
    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }



    public function courTherique()
    {
        return $this->hasMany(CourTheorique::class);
    }

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }
    public function absence(){
        return $this->hasMany(AbsenceTheoriqueMoniteur::class);
    }
}

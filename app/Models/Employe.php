<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'nom',
        'prenom',
        'CIN',
        'role',
        'date_naissance',
        'lieu_naissance',
        'email',
        'telephone',
        'date_embauche',
        'poste',
        'CAPN',
        'adresse',
        'observations',         
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }

    public function depences()
    {
        return $this->hasMany(Depence::class);
    }

    public function salaire()
    {
        return $this->hasOne(Salaire::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function controles()
    {
        return $this->hasMany(Controle::class);
    }

    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }

    public function moniteurPratique()
    {
        return $this->hasOne(MoniteurPratique::class);
    }

    public function moniteurTheorique()
    {
        return $this->hasOne(MoniteurTheorique::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoniteurTheorique extends Model
{
    use HasFactory;

    protected $fillable = [
        'employe_id',
        'auto_ecole_id'
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    public function courTherique()
    {
        return $this->hasMany(CourTheorique::class);
    }

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }
}

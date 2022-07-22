<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MoniteurTheorique extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employe_id',
        'auto_ecole_id',
        'categorie'
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

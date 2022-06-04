<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourTheorique extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'auto_ecole_id',
        'moniteur_theorique_id',
        'date',
        'date_debut',
        'date_fin',
        'permis',
        'type',
        'candidat'
    ];
     protected $casts = [
         'candidat' => 'array'
     ];
    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function moniteurTherique()
    {
        return $this->belongsTo(MoniteurTheorique::class);
    }
    public function presence_theorique()
    {
        return $this->hasMany(cour_theorique_presence::class);
    }
   
}
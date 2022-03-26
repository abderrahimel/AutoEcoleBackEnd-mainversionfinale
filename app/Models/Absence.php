<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'employe_id',
        'type_absence',
        'date_debut',
        'date_fin',
        'remarque',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }
}

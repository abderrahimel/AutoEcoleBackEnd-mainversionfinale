<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'employe_id',
        'montant',
        'date',
        'reamarques',
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

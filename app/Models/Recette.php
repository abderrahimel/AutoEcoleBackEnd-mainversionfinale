<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'type',
        'montant',
        'date',
        'remarques'
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }
}

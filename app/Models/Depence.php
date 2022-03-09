<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depence extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'categorie_depence_id',
        'employe_id',
        'date',
        'montant',
        'remarques'
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function categorie()
    {
        return $this->belongsTo(CategorieDepence::class);
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}

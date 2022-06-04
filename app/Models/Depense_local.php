<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Depense_local extends Model
{
    use HasFactory, SoftDeletes;
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
}

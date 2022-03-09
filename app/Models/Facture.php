<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'montant',
        'date',
        'candidat_id',
        'societe',
        'remarques'
    ];

   
    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }


}

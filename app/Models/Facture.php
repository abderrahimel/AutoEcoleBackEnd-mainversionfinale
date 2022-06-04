<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'auto_ecole_id',
        'date',
        'candidat_id',
        'montant_ttc',
        'montant_ht',
        'tva',
        'remarque'
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

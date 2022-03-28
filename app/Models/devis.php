<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    protected $fillable = [
        'auto_ecole_id',
        'candidat_id',
        'numero',
        'date',
        'societe',
        'montant_ht',
        'montant_ttc',
        'remarque'
    ];
}
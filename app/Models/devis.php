<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Devis extends Model
{
    use HasFactory, SoftDeletes;
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
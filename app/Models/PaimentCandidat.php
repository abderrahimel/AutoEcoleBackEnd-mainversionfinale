<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaimentCandidat extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'auto_ecole_id',
        'candidat_id',
        'date',
        'montant',
        'nom_banque',
        'image',
        'type_p',
        'numero',
        'remarque',
    ];

}            
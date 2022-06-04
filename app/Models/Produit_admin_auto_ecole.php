<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Produit_admin_auto_ecole extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nomCategorie',
        'titre',
        'prix',
        'marque',
        'modele',
        'carburant',
        'kilometrage',
        'prixPromotion',
        'description',
        'image',
    ];
}
$table->string('marque');
$table->string('modele');
$table->string('carburant');
$table->string('kilometrage');
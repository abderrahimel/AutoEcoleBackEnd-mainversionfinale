<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'auto_ecole_id',
        'prix',
        'date_fin',
        'date_debut'
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }
    
}
    
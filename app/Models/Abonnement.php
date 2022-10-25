<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Abonnement extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'auto_ecole_id',
        'user_id',
        'prix',
        'date_fin',
        'date_debut' 
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

}
    
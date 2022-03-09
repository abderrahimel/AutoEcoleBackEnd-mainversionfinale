<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'raison_social',
        'type',
        'telephone',
        'ville',
        'pays',
        'email',
        'adresse'
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function controles()
    {
        return $this->hasMany(Controle::class);
    }
}

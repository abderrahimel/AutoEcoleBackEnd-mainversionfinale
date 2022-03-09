<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'candidat_id',
        'categorie_permis_id',
        'date_examen',
        'date_depot'
    ];
    
    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }

    public function permis()
    {
        return $this->belongsTo(CategoriePermis::class);
    }
}

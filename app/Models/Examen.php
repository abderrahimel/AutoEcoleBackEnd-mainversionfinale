<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examen extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'auto_ecole_id',
        'candidat_id',
        'categorie',
        'date_examen',
        'date_depot',
        'etat_1',
        'date_etat1',
        'etat_2',
        'date_etat2',
        'note1',
        'date_note1',
        'note2',
        'date_note2',
        'resultat'
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

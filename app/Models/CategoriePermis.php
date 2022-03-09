<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriePermis extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_ecole_id',
        'categorie',
        'description'
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function examens()
    {
        return $this->hasMany(Examen::class);
    }
}

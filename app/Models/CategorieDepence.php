<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieDepence extends Model
{
    use HasFactory;
    protected $fillable = [
        'auto_ecole_id',
        'categorie'
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function depences()
    {
        return $this->hasMany(Depence::class);
    }
}

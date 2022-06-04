<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CategoriePermis extends Model
{
    use HasFactory, SoftDeletes;

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salaire extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'auto_ecole_id',
        'employe_id',
        'date',
        'montant',
    ];

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}

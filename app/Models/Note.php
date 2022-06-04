<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'auto_ecole_id',
        'categorie',
        'moyen',
        'note_generale',
    ];
}
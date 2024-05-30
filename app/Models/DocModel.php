<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'publier_le',
        'publier_par',
        'extension',
        'type_document',
        'etat',
        'description',
        'nombre_vue',
        'fichier',
    ];
}
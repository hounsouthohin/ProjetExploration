<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statistique extends Model
{
    use HasFactory;

    // Définir le nom de la table si différent de la convention (optionnel)
    protected $table = 'Statistiques';

    protected $dates = ['created_at', 'updated_at'];

}

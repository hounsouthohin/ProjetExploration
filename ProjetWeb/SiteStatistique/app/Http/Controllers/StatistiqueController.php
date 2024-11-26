<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistique;

class StatistiqueController extends Controller
{
    public function stat1()
    {
        // Récupérer toutes les statistiques pour l'humidité
        $humidites = Statistique::all()->pluck('humidite'); // Récupère toutes les valeurs de humidité
        return view('stat1', compact('humidites'));
    }

    // Méthode pour afficher les températures
    public function stat2()
    {
        // Récupérer toutes les statistiques pour la température
        $temperatures = Statistique::all()->pluck('temperature'); // Récupère toutes les valeurs de température
        return view('stat2', compact('temperatures'));
    }
}

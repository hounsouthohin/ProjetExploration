<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistique;
use Illuminate\Support\Facades\DB;
class StatistiqueController extends Controller
{
    public function stat1()
    {
        // Récupérer toutes les statistiques pour l'humidité
        $humidites = Statistique::all()->pluck('humidite'); // Récupère toutes les valeurs de humidité
        $moyHum = DB::table('statistiques')
                ->avg('humidite');
        return view('stat1', compact('humidites','moyHum'));
    }

    // Méthode pour afficher les températures
    public function stat2()
    {
        // Récupérer toutes les statistiques pour la température
        $temperatures = Statistique::all()->pluck('temperature'); // Récupère toutes les valeurs de température
        $moyTemp = DB::table('statistiques')
                ->avg('temperature');
        return view('stat2', compact('temperatures','moyTemp'));
    }
}

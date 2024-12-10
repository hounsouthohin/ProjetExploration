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
        $humidites = Statistique::orderBy('temps', 'desc')
            ->take(10)
            ->get(['humidite', 'temps']); // Récupère toutes les valeurs de humidité
        
        $moyHum = DB::table('Statistiques')
                ->avg('humidite');
        return view('stat1', compact('humidites','moyHum'));
    }

    // Méthode pour afficher les températures
    public function stat2()
    {
        // Récupérer toutes les statistiques pour la température
        $temperatures = Statistique::orderBy('temps', 'desc')
            ->take(10)
            ->get(['temperature', 'temps']); // Récupère toutes les valeurs de température
        $moyTemp = DB::table('Statistiques')
                ->avg('temperature');
        return view('stat2', compact('temperatures','moyTemp'));
    }
}

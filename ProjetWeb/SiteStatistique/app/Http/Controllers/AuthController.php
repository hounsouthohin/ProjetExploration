<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User;
class AuthController extends Controller
{
    public function welcome(){
        return view("welcome");
    }
    public function connexion(){
        return view("connexion");
    }

    public function inscription(){
        return view("inscription");
    }

    public function stat1(){return view("stat1");}

    public function stat2(){return view("stat2");}

    public function admin(){
        return view("admin");
    }

    public function connexionPost(Request $request)
    {
        // Validate and store the blog post...

        $request->validate([
            'email' => ['bail', 'required'],
            'password' => ['required'],
        ]);
        $credentials = $request->Only('email','password');
        if(Auth::attempt($credentials)){
            
            return redirect()->route('welcome');
            
        }
        return redirect()->route('connexion')->with('error','connexion échouee;veuillez reesayez');
    }

    public function inscriptionPost(Request $request)
    {
        // Validation des données d'inscription
        $request->validate([
            'email' => ['bail', 'required', 'email', 'unique:users'],
            'password' => ['required'],
            'name' => ['required']
        ]);

        // Données de l'utilisateur
        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name
        ];

        // Créer l'utilisateur dans la base de données
        $user = User::create($data);

        // Vérifier si l'utilisateur a été créé avec succès
        if (!$user) {
            return redirect()->route('inscription')->with('error', 'Inscription échouée, veuillez réessayer');
        }

        // Définir le rôle par défaut pour les utilisateurs
        // Par défaut, tous les utilisateurs auront le rôle "utilisateur"
        $role = 'utilisateur';

        // Si l'email correspond à un utilisateur spécifique, assigner le rôle "admin"
        if ($request->email === 'admin@example.com') {
            $role = 'admin';
        }

        // Assigner le rôle à l'utilisateur
        $user->assignRole($role);
        //dd($user->getRoleNames()); // Affiche les rôles de l'utilisateur
        // Rediriger avec un message de succès
        return redirect()->route('connexion')->with('success', 'Inscription réussie');
       

    }
    /*fonction pour la deconnexion*/
    public function deconnexion(){ 
        Session::flush();
        Auth::logout();
        return redirect()->route('connexion');
    }
}

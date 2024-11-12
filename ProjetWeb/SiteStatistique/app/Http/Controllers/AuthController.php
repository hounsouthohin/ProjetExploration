<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

    public function connexionPost(Request $request)
    {
        // Validate and store the blog post...

        $request->validate([
            'email' => ['bail', 'required'],
            'password' => ['required'],
        ]);
        $credentials = $request->Only('email','password');
        if(Auth::attempt($credentials)){
            return redirect()->route('inscription');
        }
        return redirect()->route('inscription')->with('error','connexion échouee;veuillez reessayer');
    }

    public function inscriptionPost(Request $request){
        
        $request->validate([
            'email' => ['bail', 'required','email','unique:utilisateurs'],
            'password' => ['required'],
            'pseudo' => ['required']
        ]);

        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['pseudo'] = $request->pseudo;
        
        $user = User::create($data); /* Utilisation du model User pour avoir acces a la BD sans requete*/

        if(!$user){
            return redirect()->route('inscription')->with('error','Inscription échouee;veuillez reessayer');
        }

        return redirect()->route('connexion')->with('success','Inscription Reussie');
    }
     
    /*fonction pour la deconnexion*/
    public function deconnexion(){ 
        Session::flush();
        Auth::logout();
        return redirect()->itended(route('connexion'));
    }
}

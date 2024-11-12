<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function connexionPost(Request $request): RedirectResponse
    {
        // Validate and store the blog post...

        $request->validate([
            'courriel' => ['bail', 'required', 'unique:posts', 'max:20'],
            'motDePasse' => ['required','max:50'],
        ]);
        $credentials = $request->Only('courriel','motDePasse');
        if(Auth::attempt($credentials)){
            return redirect()->itended(route('welcome'));
        }
        return redirect()->itended(route('connexion'))->with('error','connexion échouee;veuillez reessayer');
    }
}


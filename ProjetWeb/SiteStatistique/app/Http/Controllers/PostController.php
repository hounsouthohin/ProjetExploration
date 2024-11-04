<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
     /**
     * Show the form to create a new blog post.
     */

    public function createInscription(): View
    {
        return view('inscription');
    }

    public function createConnexion(): View
    {
        return view('connexion');
    }

     /**
     * Store a new blog post.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate and store the blog post...

        $validatedData = $request->validateWithBag('post', [
            'courriel' => ['bail', 'required', 'unique:posts', 'max:5'],
            'MotDePasse' => ['required'],
        ]);

        // The blog post is valid...
 
        return redirect('/connexion');
    }
}


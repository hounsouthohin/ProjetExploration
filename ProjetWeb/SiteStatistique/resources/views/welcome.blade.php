<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);
            font-family: 'Arial', sans-serif;
            color: #343a40;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: #ffffff;
        }
        .card-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #28a745;
        }
        .btn {
            background: #28a745;
            color: white;
            border-radius: 30px;
            padding: 10px 20px;
            transition: all 0.3s ease-in-out;
        }
        .btn:hover {
            background: #20c997;
            color: white;
        }
        .text-primary {
            color: #007bff !important;
            text-decoration: underline;
            transition: color 0.3s ease;
        }
        .text-primary:hover {
            color: #0056b3 !important;
        }
    </style>
</head>
@include('include.header')

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-5 text-center">
            @auth
                <h1 class="card-title">Bienvenue, {{ Auth::user()->name }}!</h1>
                <p class="card-text">Vous êtes connecté avec l'adresse : <strong>{{ Auth::user()->email }}</strong></p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn mt-4">Se déconnecter</button>
                </form>
            @else
                <h1 class="card-title">Bienvenue sur notre application !</h1>
                <p class="card-text">Pour accéder à votre espace, veuillez 
                    <a href="{{ route('/') }}" class="text-primary">vous connecter</a> 
                    ou vous inscrire si vous êtes un nouvel utilisateur.
                </p>
                <a href="{{ route('register') }}" class="btn mt-4">Créer un compte</a>
            @endauth
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
@include('include.footer')
</html>

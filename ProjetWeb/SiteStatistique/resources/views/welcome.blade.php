<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
@include('include.header')
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4 text-center">
            @auth
                <h1 class="card-title">Bienvenue, {{ Auth::user()->name }}!</h1>
                <p class="card-text">Vous êtes connecté avec l'adresse : <strong>{{ Auth::user()->email }}</strong></p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-3">Se déconnecter</button>
                </form>
            @else
                <h1 class="card-title">Bienvenue sur notre application !</h1>
                <p class="card-text">Veuillez <a href="{{ route('/') }}" class="text-primary">vous connecter</a> pour accéder à votre compte.</p>
            @endauth
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
@include('include.footer')
</html>

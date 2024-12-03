<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10;url={{ route('connexion') }}">
    <title>Veuillez patienter</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg" style="width: 22rem;">
        <div class="card-body text-center">
            <h4 class="card-title text-danger">Trop de tentatives !</h4>
            <p class="card-text text-muted">
                Vous avez atteint le nombre maximal de tentatives. <br>
                Veuillez patienter avant d'essayer à nouveau.
            </p>
            <div class="spinner-border text-primary my-3" role="status">
                <span class="visually-hidden">Chargement...</span>
            </div>
            <p class="small text-muted">Merci de votre compréhension.</p>
        </div>
    </div>
</body>
</html>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'administration</title>

    <!-- Lien vers le CDN de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #f8f9fa, #e9ecef);
            font-family: 'Roboto', sans-serif;
        }
        .navbar {
            background-color: #007bff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: bold;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%280, 0, 0, 0.5%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .table th {
            background-color: #f8f9fa;
            color: #007bff;
            font-weight: bold;
        }
        .table td {
            background-color: #ffffff;
            text-align: center;
            vertical-align: middle;
        }
        .btn-warning {
            background-color: #ffca28;
            border: none;
        }
        .btn-warning:hover {
            background-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .badge {
            padding: 0.5em 0.7em;
            border-radius: 10px;
        }
        footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }
        footer .nav-link {
            color: #6c757d !important;
        }
        footer .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Statistics</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="admin">Admin</a></li>
        <li class="nav-item"><a class="nav-link" href="welcome">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="connexion">Connexion</a></li>
        <li class="nav-item"><a class="nav-link" href="inscription">Inscription</a></li>
        <li class="nav-item"><a class="nav-link" href="stat1">Stat1</a></li>
        <li class="nav-item"><a class="nav-link" href="stat2">Stat2</a></li>
        <li class="nav-item"><a class="nav-link disabled" aria-disabled="true">Désactivé</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenu principal -->
<div class="container mt-5">
    <h1 class="mb-4 text-center text-primary">Page d'administration</h1>

    <!-- Affichage de message de succès -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Card pour afficher la liste des utilisateurs -->
    <div class="card shadow-sm">
        <div class="card-header text-center">
            <h4 class="mb-0">Liste des utilisateurs</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle(s)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="d-flex justify-content-between align-items-center">
                                    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                                        @csrf
                                        <select name="roles[]" class="form-select form-select-sm mb-2" multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}" 
                                                    {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-warning btn-sm">Mettre à jour</button>
                                    </form>

                                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="py-4 mt-5">
  <div class="container">
    <ul class="nav justify-content-center mb-3">
      <li class="nav-item"><a href="stat1" class="nav-link px-2 text-muted">Stat1</a></li>
      <li class="nav-item"><a href="welcome" class="nav-link px-2 text-muted">Accueil</a></li>
      <li class="nav-item"><a href="stat2" class="nav-link px-2 text-muted">Stat2</a></li>
      <li class="nav-item"><a href="admin" class="nav-link px-2 text-muted">Admin</a></li>
      <li class="nav-item"><a href="connexion" class="nav-link px-2 text-muted">Connexion</a></li>
      <li class="nav-item"><a href="inscription" class="nav-link px-2 text-muted">Inscription</a></li>
      <li class="nav-item"><a href="about" class="nav-link px-2 text-muted">À propos</a></li>
    </ul>
    <p class="text-center text-muted">&copy; 2024 Company, Inc</p>
  </div>
</footer>

<!-- Scripts JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

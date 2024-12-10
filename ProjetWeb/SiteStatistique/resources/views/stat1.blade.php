<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques d'Humidité</title>
    
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #e9f5e9, #f8f9fa);
            font-family: 'Roboto', sans-serif;
        }
        .navbar {
            background-color: #28a745;
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
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table th {
            background-color: #28a745;
            color: white;
        }
        .table td {
            background-color: #f9f9f9;
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
        <a class="navbar-brand" href="#">Statistiques</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="admin">Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="welcome">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="connexion">Connexion</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Déconnexion</a></li>
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
    <h1 class="text-center text-success mb-4">Statistiques d'Humidité</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card pour la liste des humidités -->
    <div class="card shadow-sm mb-4">
        <div class="card-header text-center">
            <h4>Liste des Humidités</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Humidité (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($humidites as $index => $humidity)
                        <tr>
                            <td>{{ $humidity->temps}}</td>
                            <td>{{ $humidity->humidite }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           <div>Moyenne : {{$moyHum}}</div> 
        </div>  
    </div>

    <!-- Graphique d'Humidité -->
    <div class="card shadow-sm">
        <div class="card-header text-center">
            <h5>Graphique d'Humidité</h5>
        </div>
        <div class="card-body">
            <canvas id="humidityChart"></canvas>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="py-3 mt-5">
    <div class="container">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="stat1" class="nav-link px-2">Stat1</a></li>
            <li class="nav-item"><a href="welcome" class="nav-link px-2">Accueil</a></li>
            <li class="nav-item"><a href="stat2" class="nav-link px-2">Stat2</a></li>
            <li class="nav-item"><a href="admin" class="nav-link px-2">Admin</a></li>
            <li class="nav-item"><a href="connexion" class="nav-link px-2">Connexion</a></li>
            <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link px-2">Déconnexion</a></li>
            <li class="nav-item"><a href="inscription" class="nav-link px-2">Inscription</a></li>
            <li class="nav-item"><a href="about" class="nav-link px-2">À propos</a></li>
        </ul>
        <p class="text-center text-muted">&copy; 2024 Company, Inc</p>
    </div>
</footer>

<!-- CDN Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Data for the chart
    const humidityData = @json($humidites);

    const humidities = humidityData.map(data => data.humidite);
    
    // Create the chart
    const ctx = document.getElementById('humidityChart').getContext('2d');
    const humidityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Array.from({ length: humidities.length }, (_, i) => `Jour ${i + 1}`),
            datasets: [{
                label: 'Humidité (%)',
                data: humidities,
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10
                    }
                }
            }
        }
    });
</script>
</body>
</html>

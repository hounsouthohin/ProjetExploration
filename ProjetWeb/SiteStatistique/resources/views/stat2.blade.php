<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques de Température</title>

    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background: #eef2f3; /* Couleur de fond claire et moderne */
            color: #2c3e50;
            font-family: 'Roboto', sans-serif;
        }

        h1 {
            font-weight: bold;
            color: #34495e;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, #4a90e2, #007bff);
            color: white;
            font-weight: bold;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            background-color: white;
            padding: 20px;
        }

        .table {
            margin: 0;
            overflow: hidden;
            border-radius: 10px;
        }

        .table th {
            background: #4a90e2;
            color: white;
        }

        .table td {
            background-color: #f9fbfc;
        }

        .navbar {
            background: #4a90e2;
            padding: 15px 20px;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
            font-weight: 500;
            margin: 0 5px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #eaf6ff;
        }

        .footer {
            background: #34495e;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }

        .footer a {
            color: #ffffff;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #4a90e2;
        }

        .chart-container {
            padding: 20px;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Boutons et transitions */
        .btn-custom {
            background: #4a90e2;
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .btn-custom:hover {
            background: #007bff;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">Statistics</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="admin">Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="welcome">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="connexion">Connexion</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">Deconnexion</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="inscription">Inscription</a></li>
                <li class="nav-item"><a class="nav-link" href="stat1">Stat1</a></li>
                <li class="nav-item"><a class="nav-link" href="stat2">Stat2</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Statistiques de Température</h1>

    @if (session('success'))
        <div class="alert alert-success text-center mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-header">
            Liste des Températures
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Température (°C)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($temperatures as $index => $temperature)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $temperature }}°C</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>Moyenne : {{$moyTemp}}</div> 
        </div>
    </div>

    <div class="chart-container mt-4">
        <canvas id="temperatureChart"></canvas>
    </div>
</div>

<footer class="footer mt-5">
    <div class="container">
        <p>&copy; 2024 Company, Inc. Tous droits réservés.</p>
        <ul class="nav justify-content-center">
            <li class="nav-item"><a href="stat1" class="nav-link">Stat1</a></li>
            <li class="nav-item"><a href="welcome" class="nav-link">Accueil</a></li>
            <li class="nav-item"><a href="stat2" class="nav-link">Stat2</a></li>
            <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">Deconnexion</a>
                </li>
            <li class="nav-item"><a href="admin" class="nav-link">Admin</a></li>
            <li class="nav-item"><a href="" class="nav-link">Acceil</a></li>
        </ul>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const temperatureData = @json($temperatures);

    const ctx = document.getElementById('temperatureChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: Array.from({ length: temperatureData.length }, (_, i) => `Jour ${i + 1}`),
            datasets: [{
                label: 'Température (°C)',
                data: temperatureData,
                borderColor: '#4a90e2',
                backgroundColor: 'rgba(74, 144, 226, 0.2)',
                tension: 0.4,
                borderWidth: 3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: false,
                }
            }
        }
    });
</script>
</body>
</html>

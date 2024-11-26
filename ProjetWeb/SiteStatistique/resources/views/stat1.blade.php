<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques d'Humidité</title>
    
    <!-- CDN Bootstrap pour le style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJmPhXkB7f9nY5m3S6Hf3Hqz6bB+mG3cGGM2Z54t7Tk70MkQ7vtxU+7nA0zq" crossorigin="anonymous">

    <!-- CDN Chart.js pour intégrer un graphique -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Personnalisation des couleurs pour rendre la page plus agréable */
        .card-header {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }
        .card-body {
            background-color: #f8f9fa;
        }
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
        .table th {
            background-color: #28a745;
            color: white;
        }
        .table td {
            background-color: #e9ecef;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h1 class="mb-4 text-center text-success">Statistiques d'Humidité</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card pour la liste des humidités -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Liste des Humidités</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Humidité (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through the humidities -->
                        @foreach ($humidites as $index => $humidity)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $humidity }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Graphique d'Humidité -->
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h5>Graphique d'Humidité</h5>
            </div>
            <div class="card-body">
                <canvas id="humidityChart"></canvas>
            </div>
        </div>
    </div>

    <!-- CDN Bootstrap JS (Optionnel pour des composants JS de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-8WkkkGzVgZKkHjIHKLUnHhNk2DoyH0FjlXKQZpG2fKM+XBKN2t60btgC1hjl5U0M" crossorigin="anonymous"></script>

    <script>
        // Data for the chart
        const humidityData = @json($humidites); // Pass your humidity data from Laravel to JavaScript
        
        // Create the chart
        const ctx = document.getElementById('humidityChart').getContext('2d');
        const humidityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: Array.from({ length: humidityData.length }, (_, i) => `Jour ${i + 1}`), // Example labels, e.g., 'Jour 1', 'Jour 2'
                datasets: [{
                    label: 'Humidité',
                    data: humidityData,
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false,
                        ticks: {
                            stepSize: 5
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>

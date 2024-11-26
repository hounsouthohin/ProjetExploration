
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'administration</title>

    <!-- Lien vers le CDN de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Si vous avez un fichier CSS personnalisé, vous pouvez l'ajouter ici -->
    <!-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> -->
</head>
<body>
@include('include.header')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Page d'administration</h1>

        <!-- Affichage de message de succès -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Card pour afficher la liste des utilisateurs -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Liste des utilisateurs</h4>
            </div>
            <div class="card-body">
                <!-- Table Responsive -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
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
                                    <td class="d-flex justify-content-between">
                                        <!-- Formulaire de modification -->
                                        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="roles" class="form-label">Modifier le rôle :</label>
                                                <select name="roles[]" class="form-select" multiple>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}" 
                                                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-warning btn-sm">Mettre à jour</button>
                                        </form>

                                        <!-- Formulaire de suppression -->
                                        <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" style="display: inline;">
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

    <!-- Scripts JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
@include('include.footer')
</html>



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
class RolePermissions extends Controller
{
    public function createRolesAndPermissions()
    {
        // 1. Créer les permissions
        $permissions = ['admin', 'stat1', 'stat2', 'utilisateur'];
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // 2. Créer les rôles
        $roles = ['admin', 'utilisateur'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // 3. Attribuer les permissions aux rôles
        $adminRole = Role::findByName('admin');
        $userRole = Role::findByName('utilisateur');

        // Admin a toutes les permissions
        $adminRole->syncPermissions(Permission::all());

        // Utilisateur a seulement la permission "stat1"
        $userRole->syncPermissions(['stat1']);

        return response()->json([
            'message' => 'Rôles et permissions créés avec succès.',
        ]);
    }

    public function adminPage()
{
    // Récupérer tous les utilisateurs avec leurs rôles
    $users = User::with('roles')->get();

    // Récupérer tous les rôles disponibles pour modification
    $roles = Role::all();

    // Retourner la vue avec les données
    return view('admin', compact('users', 'roles'));
}


public function updateUserRole(Request $request, $id)
{
    $request->validate([
        'roles' => ['array', 'required'], // Validation pour les rôles
    ]);

    // Récupérer l'utilisateur
    $user = User::findOrFail($id);

    // Synchroniser les rôles de l'utilisateur
    $user->syncRoles($request->roles);

    return redirect()->route('admin.dashboard')->with('success', 'Rôles mis à jour avec succès.');
}

public function edit($id)
{
    // Récupérer l'utilisateur
    $user = User::findOrFail($id);

    // Récupérer tous les rôles disponibles
    $roles = Role::all();

    return view('admin.users.edit', compact('user', 'roles'));
}


public function deleteUser($id)
{
    $user = User::findOrFail($id);

    // Supprimer l'utilisateur
    $user->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Utilisateur supprimé avec succès.');
}


}



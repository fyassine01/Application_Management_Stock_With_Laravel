<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class ProfilControlleur extends Controller
{

    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('admin/profil', compact('user'));
    }

    public function modifier(Request $request)
    {
        // Valider les données
        $id = Auth::guard('admin')->user()->id;
        $validatedData = $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|string|email|max:120|unique:Admins,email,' . $id.',id',
            'password' => 'nullable|string|confirmed|min:3',
        ]);

        // Récupérer l'Admin actuellement authentifié
        $user = Admin::find(Auth::guard('admin')->user()->id);

        if (!$user) {
            return redirect()->back()->withErrors('Admin non trouvé.');
        }

        // Mettre à jour les champs sauf le username
        $user->nom = $validatedData['nom'];
        $user->prenom = $validatedData['prenom'];
        $user->email = $validatedData['email'];

        // Si un nouveau mot de passe est fourni, on l'encrypte
        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Sauvegarder les modifications
        $user->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Profil mis à jour avec succès!');
    }
}

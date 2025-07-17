<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    // Affiche la liste des Users
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

// Ajoute un nouvel User
public function store(Request $request)
{
    // Validation des champs
    //dd($request) ;
    $request->validate([
        'nom' => 'required|string|max:50',
        'prenom' => 'required|string|max:50',
        'name' => 'required|string|max:100|unique:Users,name',
        'email' => 'required|string|email|max:120|unique:Users,email',
        'password' => 'required|string|min:3|confirmed',  // Vérification de la confirmation de mot de passe
    ]);

    // Création de l'User
    User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),  // Hash du mot de passe
        
    ]);

    return redirect()->route('admin.users')->with('success', 'User ajouté avec succès.');
}


    // Supprime un User
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.users')->with('success', 'User supprimé avec succès.');
        }
        return redirect()->route('admin.users')->with('error', 'User non trouvé.');
    }
}


<?php

namespace App\Http\Controllers\Admin;


use App\Models\Produit;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class ProduitsControlleur extends Controller
{



    public function index(Request $request)
    {
        $query = $request->input('query');
        if ($query) {
            // Recherche de produits uniquement par nom
            $produits = Produit::where('nom', 'LIKE', "%{$query}%")->get();
        } else {
            $produits = Produit::all();
        }

        return view('admin/produits', compact('produits', 'query'));
    }
    public function ajouter(Request $request) {
        // Validation des données d'entrée, y compris le champ image
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|unique:produits',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'quantité_actual' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validation de l'image
        ]);
    
        // Si une image est téléchargée, la stocker
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        // Définir quantité_initial avec la même valeur que quantité_actual
        $validatedData['quantité_initial'] = $validatedData['quantité_actual'];
    
        // Créer le produit avec les données validées
        Produit::create($validatedData);
    
        return redirect()->route('produits')->with('success', 'Produit ajouté avec succès !');
    }
    

    public function supprimer($id_produit){
            $user = Produit::find($id_produit);
            if ($user) {
                $user->delete();
                return redirect()->route('produits')->with('success', 'Utilisateur supprimé avec succès.');
            }
            return redirect()->route('produits')->with('error', 'Utilisateur non trouvé.');
        }


        public function edit($id_produit) {
            $produit = Produit::findOrFail($id_produit);
            return view('admin/edit', compact('produit'));
        }
        
        public function update(Request $request, $id_produit) {
            $request->validate([
                'nom' => 'required|max:100',
                'description' => 'nullable|max:5000',
                'prix' => 'required|numeric',
                'quantité_actual' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validation pour l'image
            ]);
        
            $produit = Produit::findOrFail($id_produit);
    
            // Gestion de l'image
            if ($request->hasFile('image')) {
                // Suppression de l'ancienne image si elle existe
                //    if ($produit->image && Storage::disk('public')->exists($produit->image)) {
                //        Storage::disk('public')->delete($produit->image);
                //    }
    
                // Stockage de la nouvelle image
                $imagePath = $request->file('image')->store('produits', 'public');
                $produit->image = $imagePath;
            }
        
            $produit->nom = $request->input('nom');
            $produit->description = $request->input('description');
            $produit->prix = $request->input('prix');
            $produit->quantité_actual = $request->input('quantité_actual');
            $produit->save();
        
            return redirect()->route('produits')->with('success', 'Produit mis à jour avec succès.');
        }



}

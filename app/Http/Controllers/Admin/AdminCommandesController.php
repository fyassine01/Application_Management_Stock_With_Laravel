<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use \App\Models\Mouvement;


class AdminCommandesController extends Controller
{

    public function index()
    {
        $commandes = Commande::with(['client', 'details.produit'])->latest()->get();
        $commandesEnAttente = Commande::where('status', 'en attente')->count();
        $commandesValidees = Commande::where('status', 'validee')->count();
        $commandesRefusees = Commande::where('status', 'refusee')->count();

        return view('admin.commandes', compact(
            'commandes',
            'commandesEnAttente',
            'commandesValidees',
            'commandesRefusees'
        ));
    }

    public function valider(Commande $commande)
    {
        // Mettre à jour le statut de la commande
        $commande->update(['status' => 'validee']);
    
        // Récupérer les détails de la commande (produits et quantités associées)
        foreach ($commande->details as $detail) {
            // Récupérer le produit associé
            $produit = \App\Models\Produit::find($detail->id_produit);
            
            if ($produit) {
                // Soustraire la quantité commandée de la quantité actuelle du produit
                $nouvelleQuantite = $produit->quantité_actual - $detail->quantité;
    
                // Mettre à jour la quantité actuelle du produit
                $produit->update(['quantité_actual' => $nouvelleQuantite]);
    
                // Créer un nouveau mouvement pour le produit
                Mouvement::create([
                    'id_produit' => $detail->id_produit,
                    'id_administrateur' => Auth::guard('admin')->user()->id, // Utilise l'ID de l'utilisateur connecté comme administrateur
                    'quantité' => $detail->quantité, // Quantité associée au produit
                    'type' => 'sortie', // Type de mouvement de sortie
                    'date_mouvements' => now(), // Date du mouvement (peut être modifiée si nécessaire)
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Commande validée avec succès et mouvements créés.');
    }
    
    

    public function refuser(Commande $commande)
    {
        $commande->update(['status' => 'refusee']);
        return redirect()->back()->with('success', 'Commande refusée avec succès');
    }

}
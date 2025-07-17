<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        // Récupérer toutes les commandes de l'utilisateur connecté
        $commandes = Commande::with(['details.produit'])
            ->where('id_client', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculer les totaux et formater les données pour chaque commande
        $commandes = $commandes->map(function ($commande) {
            $total = 0;
            $nombreProduits = 0;

            foreach ($commande->details as $detail) {
                $total += $detail->produit->prix * $detail->quantité;
                $nombreProduits += $detail->quantité;
            }

            return [
                'id' => $commande->id,
                'numero' => 'CMD-' . date('Y', strtotime($commande->created_at)) . '-' . str_pad($commande->id, 3, '0', STR_PAD_LEFT),
                'date_commande' => $commande->date_creation,
                'status' => $commande->status,
                'total' => $total,
                'nombre_produits' => $nombreProduits,
                'date_livraison' => date('Y-m-d', strtotime($commande->created_at . ' +2 days')),
                'details' => $commande->details->map(function ($detail) {
                    return [
                        'produit' => $detail->produit,
                        'quantité' => $detail->quantité,
                        'prix_unitaire' => $detail->produit->prix
                    ];
                })
            ];
        });

        return view('suitCommandes', compact('commandes'));
    }

    public function show($id)
    {
        $commande = Commande::with(['details.produit'])
            ->where('id_client', Auth::id())
            ->findOrFail($id);

        return view('commandes.show', compact('commande'));
    }
}
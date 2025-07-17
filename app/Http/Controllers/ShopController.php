<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Routing\Controller;
use App\Models\Commande;
use App\Models\DetailsCommande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ShopController extends Controller
{
    //
    /*
    public function __construct()
    {
    $this->middleware('auth:client');
    }*/

    public function index()
    {
        // Récupérer tous les produits depuis la base de données
        //$produits = Produit::all();


        
            $produits = Produit::paginate(5);

            // Retourner la vue 'shop' avec les produits
            return view('shop', compact('produits'));

    }

    public function createOrder(Request $request)
    {
        try {
            DB::beginTransaction();

            // Créer la commande
            $commande = new Commande();
            $commande->id_client = Auth::id(); // Utilise l'ID de l'utilisateur connecté
            $commande->date_creation = now(); // Utilise la date et l'heure actuelles
            $commande->status = 'en attente';
            $commande->save();

            // Ajouter les détails de la commande
            foreach ($request->items as $item) {
                // Rechercher le produit par son nom
                $produit = Produit::where('nom', $item['nom'])->first();

                if (!$produit) {
                    throw new \Exception("Produit non trouvé : " . $item['nom']);
                }

                $detailCommande = new DetailsCommande();
                $detailCommande->id_commande = $commande->id;
                $detailCommande->id_produit = $produit->id_produit;
                $detailCommande->quantité = $item['quantité'];
                $detailCommande->save();
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Commande créée avec succès']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Erreur lors de la création de la commande', 'error' => $e->getMessage()], 500);
        }
    }

    // ... other methods

// In your ShopController search method
/*
public function search(Request $request)
{
    $searchTerm = $request->input('q');

    $products = Produit::where('nom', 'like', "%$searchTerm%")
        ->orWhere('description', 'like', "%$searchTerm%")
        ->paginate(5);


    return response()->json([
        'products' => $products->items(),
        'links' => $products->links()->toArray()['links'],  // Access the 'links' array
    ]);
}*/

public function search(Request $request)
{
    // Valider la requête
    $request->validate([
        'q' => 'nullable|string|max:255'
    ]);

    $searchTerm = $request->input('q');
    
    // Si le terme de recherche est vide, rediriger vers la page principale
    if (empty($searchTerm)) {
        return redirect()->route('shop');
    }

    // Effectuer la recherche
    $produits = Produit::where(function($query) use ($searchTerm) {
        $query->where('nom', 'like', "%{$searchTerm}%")
              ->orWhere('description', 'like', "%{$searchTerm}%");
    })->paginate(5)->withQueryString();

    // Passer le terme de recherche à la vue pour l'afficher
    return view('shop', [
        'produits' => $produits,
        'searchTerm' => $searchTerm
    ]);
}
}

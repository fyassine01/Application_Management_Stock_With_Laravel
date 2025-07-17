<?php

namespace App\Http\Controllers\Admin;
use App\Models\Produit;
use App\Models\Mouvement;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MouvementsControlleur extends Controller
{
    

    public function index(){
        $produits=Produit::all();
        return view('admin/mouvements',compact('produits'));
    }

    public function affiche(Request $request){

        $mouvements=Mouvement::where('id_produit', '=', $request->id_produit)
        ->orderBy('date_mouvements', 'desc')
        ->get();
        $Sproduit=Produit::where('id_produit','=',$request->id_produit)->get();


        $produits=Produit::all();
        return view('admin/mouvements',compact('produits','mouvements','Sproduit'));

       
    }


    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'id_produit' => 'required|exists:produits,id_produit',
            'type' => 'required|in:entre,sortie',
            'quantite' => 'required|integer|min:1',
            'date_mouvements' => 'required|date',
        ]);
    
        // Récupérer le produit
        $produit = Produit::findOrFail($request->id_produit);
    
        // Mettre à jour la quantité actuelle du produit
        if ($request->type == 'entre') {
            $produit->quantité_actual += $request->quantite;
        } else { // sortie
            // Vérifier si la quantité est suffisante
            if ($produit->quantité_actual < $request->quantite) {
                return redirect()->back()->with('error', 'Quantité insuffisante en stock.');
            }
            $produit->quantité_actual -= $request->quantite;
        }
    
        // Sauvegarder les changements
        $produit->save();
    
        // Création d'un nouveau mouvement
        //dd(Auth::guard('admin')->id());
        $adminId = Auth::guard('admin')->id();
        Mouvement::create([
            'id_produit' => $request->id_produit,
            'id_administrateur' =>$adminId,
            'quantité' => $request->quantite,
            'type' => $request->type,
            'date_mouvements' => $request->date_mouvements,

        ]);
    
        return redirect()->route('mouvements')->with('success', 'Mouvement ajouté avec succès et stock mis à jour !');
    }


    public function create() {
        $produits=Produit::all();
        return view('admin/create_mouvement',compact('produits'));
    }
    

    

}

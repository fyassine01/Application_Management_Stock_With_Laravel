<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashbordControlleur extends Controller
{

    public function index(){
        $produits=Produit::all();
        $produitsFaibles = Produit::where('quantité_actual', '<=', 100)
        ->orderBy('quantité_actual', 'asc')
        ->get();


                // 1. Nombre total de produits
                $nombreProduits = DB::table('produits')->count();

                // 2. Valeur totale du stock (quantité * prix)
                $valeurTotaleStock = DB::table('produits')
                    ->sum(DB::raw('quantité_actual * prix'));
        
                // 3. Nombre total de mouvements (entrées et sorties)
                $nombreMouvements = DB::table('mouvements')->count();
        

        return view('admin/dashboard',compact('produits','produitsFaibles','nombreProduits','valeurTotaleStock','nombreMouvements',));
    }
}

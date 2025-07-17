<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailsCommande extends Model
{
    //
        // Dans le modèle DetailsCommande
        public function produit()
        {
            return $this->belongsTo(Produit::class, 'id_produit');
        }
}

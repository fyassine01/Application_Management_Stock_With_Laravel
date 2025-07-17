<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouvement extends Model
{
    use HasFactory;

    protected $table = 'mouvements';

    protected $primaryKey = 'id_mouvement';

    protected $fillable = [
        'id_produit',
        'id_administrateur',
        'quantité',
        'type',
        'date_mouvements',
    ];

    // Relation avec Produit
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }

    // Relation avec Admin
    public function administrateur()
    {
        return $this->belongsTo(Admin::class, 'id_administrateur');
    }
}

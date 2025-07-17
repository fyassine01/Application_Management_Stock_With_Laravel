<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{

    use HasFactory;
    // Spécifier la table associée
    protected $table = 'produits';

    // Spécifier la clé primaire si elle n'est pas "id"
    protected $primaryKey = 'id_produit';

    // Indiquer que la table n'a pas les colonnes created_at et updated_at
    public $timestamps = false;

    // Spécifier les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'quantité_actual',
        'quantité_initial',
        'image'
    ];
}


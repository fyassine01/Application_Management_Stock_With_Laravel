<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    //

    protected $fillable = [
        'id_client',
        'date_creation',
        'status'
    ];

    // Dans le modèle Commande
    public function details()
    {
        return $this->hasMany(DetailsCommande::class, 'id_commande');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'id_client', 'id');
    }

}

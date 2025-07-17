@extends('admin/layouts/model_page')

@section('titre')
Mouvements
@endsection

@section('page')

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suivi Historique Produit</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Styles existants... */

      /* Styling the timeline */
      .timeline {
      position: relative;
      max-width: 900px;
      margin: 20px auto;
      transition: all 0.3s ease-in-out;
    }
    .timeline::after {
      content: '';
      position: absolute;
      width: 6px;
      background-color: #f9a134;
      top: 0;
      bottom: 0;
      left: 50%;
      margin-left: -3px;
    }
    .container {
      padding: 10px 40px;
      position: relative;
      background-color: inherit;
      width: 50%;
      transition: all 0.3s ease-in-out;
    }
    .container.left {
      left: 0;
    }
    .container.right {
      left: 50%;
    }
    .container::after {
      content: '';
      position: absolute;
      width: 25px;
      height: 25px;
      right: -17px;
      background-color: white;
      border: 4px solid #f9a134;
      top: 15px;
      border-radius: 50%;
      z-index: 1;
    }
    .right::after {
      left: -16px;
    }
    .content {
      padding: 20px;
      background-color: white;
      position: relative;
      border-radius: 6px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease-in-out;
    }
    .container.left .content {
      transform: translateX(-20px);
    }
    .container.right .content {
      transform: translateX(20px);
    }
    .date {
      font-size: 14px;
      color: #999;
    }
    h2 {
      margin-bottom: 10px;
      font-size: 18px;
      color: #333;
    }
    p {
      margin: 10px 0;
    }


    /* Style moderne du formulaire de sélection de produit */
#selectProductForm {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  max-width: 500px;
  margin: 20px auto;
}

#selectProductForm label {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 10px;
  color: #333;
}

#selectProductForm select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 16px;
  margin-bottom: 20px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

#selectProductForm select:focus {
  border-color: #f9a134;
  box-shadow: 0 0 8px rgba(249, 161, 52, 0.6);
}

#selectProductForm button {
  padding: 12px 20px;
  background-color: #f9a134;
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

#selectProductForm button:hover {
  background-color: #e4892d;
}

.content {
  text-align: center;
  margin-top: 20px;
  font-size: 24px; /* Ajuster la taille du texte si nécessaire */
  font-weight: bold; /* Si vous souhaitez mettre en gras */
}


    /* Style du bouton d'ajout */




    

    /* Nouveau style pour les boutons de navigation */
    .nav-buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    .nav-button {
      padding: 12px 20px;
      background-color: #f9a134;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-decoration: none;
    }

    .nav-button:hover {
      background-color: #e4892d;
    }
  </style>
</head>
<body>
  <!-- Nouveaux boutons de navigation -->
  <div class="nav-buttons">
    <a href="{{ route('mouvements.create') }}" class="nav-button">Ajouter un mouvement</a>
    <a href="{{ route('mouvements') }}" class="nav-button">Actualiser</a>
  </div>

  <!-- Reste du contenu... -->

  <!-- Formulaire de sélection de produit -->
  <form id="selectProductForm" method="POST" action="{{route('mouvements.affiche')}}">
    @csrf
    <label for="product">Choisir un produit :</label>
    <select id="product" name="id_produit" required>
      <option value="">--Sélectionner un produit--</option>
      @foreach ($produits as $produit)
        <option value="{{ $produit->id_produit }}">{{ $produit->nom }}</option>
      @endforeach
    </select>
    <button type="submit">Voir l'historique</button>
  </form>

  <!-- Timeline des mouvements -->
  @isset($mouvements)
  <div class="content">{{$Sproduit[0]->nom}}</div>
  <div class="timeline">
    @foreach ($mouvements as $mouvement)
      <div class="container {{ $mouvement->type == 'entre' ? 'left' : 'right' }}">
        <div class="content">
          <h2>{{ ucfirst($mouvement->type) }} - {{ $mouvement->quantité }} unités</h2>
          <p class="date">{{ $mouvement->date_mouvements }}</p>
          <p>{{ $mouvement->type == 'entre' ? 'Ajouté' : 'Retiré' }} par: {{ $mouvement->administrateur->name }}</p>
        </div>
      </div>
    @endforeach
  </div>
  @endisset

</body>
</html>
@endsection
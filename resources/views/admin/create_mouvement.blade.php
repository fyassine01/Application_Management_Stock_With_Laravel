@extends('admin/layouts/model_page')

@section('titre')
Ajouter un Mouvement
@endsection

@section('page')

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un Mouvement</title>
  <link rel="stylesheet" href="style.css">
  <style>


    .container {
      max-width: 600px;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-top: 10px;
      font-weight: bold;
    }

    input, select {
      margin-bottom: 15px;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    button {
      padding: 10px;
      background-color: #f9a134;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #e4892d;
    }

    .nav-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #f9a134;
      color: white;
      text-decoration: none;
      border-radius: 4px;
      margin-top: 20px;
    }

    .nav-button:hover {
      background-color: #e4892d;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Ajouter un Mouvement</h1>

    <form  action="{{ route('mouvements.store') }}" method="POST">
      @csrf
      <label for="id_produit">Produit :</label>
      <select id="id_produit" name="id_produit" required>
        <option value="">--Sélectionner un produit--</option>
        @foreach ($produits as $produit)
          <option value="{{ $produit->id_produit }}">{{ $produit->nom }}</option>
        @endforeach
      </select>

      <label for="type">Type de mouvement :</label>
      <select id="type" name="type" required>
        <option value="entre">Entrée</option>
        <option value="sortie">Sortie</option>
      </select>

      <label for="quantite">Quantité :</label>
      <input type="number" id="quantite" name="quantite" required min="1">

      <label for="date_mouvements">Date :</label>
      <input type="date" id="date_mouvements" name="date_mouvements" required>

      <input type="hidden" name="id_administrateur " value="{{ Auth::guard('admin')->id() }}">

      <button type="submit">Ajouter le mouvement</button>
    </form>

    <a href="{{ route('mouvements') }}" class="nav-button">Retour aux mouvements</a>
  </div>
</body>
</html>
@endsection
@extends('admin/layouts/model_page')
@section('titre')
dashboard
@endsection

@section('page')

<div class="overview-boxes">
  <!-- Produits -->
  <div class="box">
      <div class="right-side">
          <div class="box-topic">Nombre de Produits</div>
          <div class="number">{{ $nombreProduits }}</div>
          <div class="indicator">
              <i class="bx bx-up-arrow-alt"></i>
              <span class="text">Total</span>
          </div>
      </div>
      <i class="bx bx-box cart"></i> <!-- Icône pour les produits -->
  </div>

  <!-- Valeur du stock -->
  <div class="box">
      <div class="right-side">
          <div class="box-topic">Valeur du Stock</div>
          <div class="number">{{ $valeurTotaleStock }} MAD</div>
          <div class="indicator">
              <i class="bx bx-up-arrow-alt"></i>
              <span class="text">Total</span>
          </div>
      </div>
      <i class="bx bx-dollar cart two"></i> <!-- Icône pour la valeur du stock -->
  </div>

  <!-- Mouvements -->
  <div class="box">
      <div class="right-side">
          <div class="box-topic">Nombre de Mouvements</div>
          <div class="number">{{ $nombreMouvements }}</div>
          <div class="indicator">
              <i class="bx bx-up-arrow-alt"></i>
              <span class="text">Total</span>
          </div>
      </div>
      <i class="bx bx-transfer cart three"></i> <!-- Icône pour les mouvements -->
  </div>
</div>

        <div class="sales-boxes">
        <div class="product-list">
            <h2>Liste des produits</h2>
            <table>
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Description</th>
                  <th>Prix unitaire</th>
                  <th>Quantité</th>
               
                </tr>
              </thead>
              <tbody>
                <!-- Here you would dynamically populate the table rows with product data -->
                @foreach($produits as $produit)
                <tr>
                  <td>{{$produit['nom']}}</td>
                  <td>{{$produit['description']}}</td>
                  <td>{{$produit['prix']}}</td>
                  <td>{{$produit['quantité_actual']}}</td>
                 
                </tr>
                @endforeach
                <!-- More rows here -->
              </tbody>
            </table>

            <div class="button">
              <a href="{{route('produits')}}">Voir Tout</a>
            </div>
          </div>

          <div class="product-list" id="faible-quantite">
            <h2>Liste des produits a Faible quantite</h2>
            <table>
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Quantité</th> 
                </tr>
              </thead>
              <tbody>
                <!-- Here you would dynamically populate the table rows with product data -->
                @foreach($produitsFaibles as $produit)
                <tr>
                  <td>{{$produit['nom']}}</td>
                  <td>{{$produit['quantité_actual']}}</td>
                  
                </tr>
                @endforeach
                <!-- More rows here -->
              </tbody>
            </table>
          </div>



        </div>
@endsection
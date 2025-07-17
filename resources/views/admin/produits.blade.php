@extends('admin/layouts.model_page')
@section('titre')
produits
@endsection

@section('page')
<style>
  .button-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }

  .button-container button {
    margin: 0 10px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50; /* Green */
    color: white;
    cursor: pointer;
  }

  .search-box {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }

  .search-box input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
/*
  .search-box button {
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    margin-left: 10px;
  }*/

  .modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 300px;
  border-radius: 5px;
  text-align: center;
}

.modal h2 {
  margin-top: 0;
}

.modal-buttons {
  margin-top: 20px;
}

.btn-confirm, .btn-cancel {
  padding: 10px 20px;
  margin: 0 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-confirm {
  background-color: #4CAF50;
  color: white;
}

.btn-cancel {
  background-color: #f44336;
  color: white;
}

/* Ajoutez ces styles dans votre section style existante */
.image-upload-container {
  margin-bottom: 20px;
}

.image-upload-container label {
  display: block;
  margin-bottom: 8px;
}

.image-preview {
  max-width: 200px;
  max-height: 200px;
  margin-top: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  display: none;
}

.custom-file-input {
  position: relative;
  display: inline-block;
}

.custom-file-input input[type="file"] {
  display: none;
}

.custom-file-label {
  padding: 8px 12px;
  background-color: #f8f9fa;
  border: 1px solid #ddd;
  border-radius: 4px;
  cursor: pointer;
  display: inline-block;
}

.custom-file-label:hover {
  background-color: #e9ecef;
}

.product-list img.thumbnail {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 4px;
}

</style>

<div class="button-container">
  <button id="addButton">Ajouter</button>
  <button id="searchButton">Rechercher</button>
</div>

<form method="GET" action="{{ route('produits') }}">
  <div class="search-box" id="search-box">
    <input type="text" name="query" placeholder="Recherche par nom..." value="{{ request()->input('query') }}" />
    <button type="submit" class="btn btn-primary"><i class="bx bx-search"></i></button>
  </div>
</form>

<div class="product-management">
  <div class="product-form" id="product-form" style="display: none;">
    <h2>Ajouter un produit</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('produit.ajouter') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="nom">Nom de l'article:</label>
        <input type="text" id="nom" name="nom" required>
      </div>
      <div class="form-group">
        <label for="quantité_actual">Quantité:</label>
        <input type="number" id="quantité_actual" name="quantité_actual" required>
      </div>
      <div class="form-group">
        <label for="prix">Prix unitaire:</label>
        <input type="number" id="prix" name="prix" required>
      </div>
      <div class="form-group">
        <label for="description">Description :</label>
        <textarea id="description" name="description" placeholder="description..."></textarea>
      </div>
      
      <div class="form-group image-upload-container">
        <label for="image">Image du produit:</label>
        <div class="custom-file-input">
          <input type="file" id="image" name="image" accept="image/*">
          <label for="image" class="custom-file-label">Choisir une image</label>
        </div>
        <img id="imagePreview" class="image-preview" alt="Aperçu de l'image">
      </div>
      <button type="submit">Valider</button>
    </form>
  </div>

  <div class="product-list" id="product-list">
    <h2>Liste des produits</h2>
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Description</th>
          <th>Prix unitaire</th>
          <th>Quantité</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @if($produits->isEmpty())
        <tr>
          <td colspan="5">Aucun produit trouvé.</td>
        </tr>
        @else
        @foreach($produits as $produit)
        <tr>
          <td>{{ $produit->nom }}</td>
          <td>{{ $produit->description }}</td>
          <td>{{ $produit->prix }}</td>
          <td>{{ $produit->quantité_actual }}</td>
          <td>
            <a href="{{ route('produit.editer', $produit->id_produit) }}"><i class='bx bx-edit'></i></a>
            
            <form action="{{ route('produit.supprimer', $produit->id_produit) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" style="background:none;border:none;color:red;cursor:pointer;"><i class='bx bx-trash'></i></button>
            </form>
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

<div id="confirmationModal" class="modal">
  <div class="modal-content">
    <h2>Confirmation</h2>
    <p>Êtes-vous sûr de vouloir supprimer ce produit ?</p>
    <div class="modal-buttons">
      <button id="confirmDelete" class="btn-confirm">Confirmer</button>
      <button id="cancelDelete" class="btn-cancel">Annuler</button>
    </div>
  </div>
</div>




<script>
  const addButton = document.getElementById('addButton');
  const searchButton = document.getElementById('searchButton');
  const productForm = document.getElementById('product-form');
  const searchBar = document.getElementById('search-box');
  const productList = document.getElementById('product-list');

  @if ($errors->any())
  productForm.style.display = 'block';
  productList.style.display = 'none';
  searchButton.style.display = 'none';
  searchBar.style.display = 'none';
  addButton.textContent = 'Liste produits';
  @endif

  addButton.addEventListener('click', () => {
    if (productForm.style.display === 'none') {
      productForm.style.display = 'block';
      productList.style.display = 'none';
      searchButton.style.display = 'none';
      searchBar.style.display = 'none';
      addButton.textContent = 'Liste produits';
    } else {
      productForm.style.display = 'none';
      productList.style.display = 'block';
      addButton.textContent = 'Ajouter';
      searchButton.style.display = 'block';
    }
  });

  searchButton.addEventListener('click', () => {
    if (searchBar.style.display === 'none') {
      searchBar.style.display = 'block';
    } else {
      searchBar.style.display = 'none';
    }
  });


  // Ajoutez ce code JavaScript à la fin de votre script existant
const modal = document.getElementById('confirmationModal');
const confirmDeleteBtn = document.getElementById('confirmDelete');
const cancelDeleteBtn = document.getElementById('cancelDelete');
let currentDeleteForm = null;

// Fonction pour ouvrir la boîte de dialogue modale
function openModal(deleteForm) {
  modal.style.display = 'block';
  currentDeleteForm = deleteForm;
}

// Fonction pour fermer la boîte de dialogue modale
function closeModal() {
  modal.style.display = 'none';
  currentDeleteForm = null;
}

// Gestionnaire d'événements pour le bouton de confirmation
confirmDeleteBtn.addEventListener('click', () => {
  if (currentDeleteForm) {
    currentDeleteForm.submit();
  }
  closeModal();
});

// Gestionnaire d'événements pour le bouton d'annulation
cancelDeleteBtn.addEventListener('click', closeModal);

// Fermer la modale si l'utilisateur clique en dehors
window.addEventListener('click', (event) => {
  if (event.target === modal) {
    closeModal();
  }
});

// Remplacez le gestionnaire d'événements existant pour les boutons de suppression
document.querySelectorAll('form[action^="{{ route('produit.supprimer', '') }}"]').forEach(form => {
  form.onsubmit = function(event) {
    event.preventDefault();
    openModal(this);
  };
});


/* Ajoutez ce script à la fin de votre section script */
const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('imagePreview');
const fileLabel = document.querySelector('.custom-file-label');

imageInput.addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      imagePreview.style.display = 'block';
      imagePreview.src = e.target.result;
    }
    reader.readAsDataURL(file);
    fileLabel.textContent = file.name;
  } else {
    imagePreview.style.display = 'none';
    imagePreview.src = '';
    fileLabel.textContent = 'Choisir une image';
  }
});

document.getElementById("image").addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("imagePreview").src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

</script>
@endsection

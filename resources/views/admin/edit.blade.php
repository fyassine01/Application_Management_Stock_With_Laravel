@extends('admin/layouts.model_page')
@section('titre')
Modifier produit
@endsection

@section('page')

<style>
    /* Container Styling */
    .form-container {
        max-width: 700px;
        margin: 50px auto;
        padding: 40px;
        border-radius: 12px;
        background-color: #f9fafc;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    /* Heading */
    h2 {
        text-align: center;
        font-size: 28px;
        margin-bottom: 30px;
        color: #333;
        font-weight: 600;
        letter-spacing: 1px;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 25px;
    }

    label {
        font-size: 15px;
        color: #555;
        font-weight: 500;
        display: block;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    /* Input and Textarea Styling */
    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 14px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f4f7f8;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus {
        border-color: #007bff;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
    }

    textarea {
        resize: vertical;
        height: 180px;
    }

    /* Button Styling */
    button {
        width: 100%;
        padding: 14px;
        background-color: #007bff;
        border: none;
        border-radius: 8px;
        font-size: 17px;
        color: white;
        cursor: pointer;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 8px rgba(0, 91, 187, 0.2);
    }

    /* Link Styling */
    a {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #007bff;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
    }

    a:hover {
        text-decoration: underline;
    }

    /* Error Alert */
    .alert {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .alert li {
        list-style-type: none;
        font-size: 14px;
    }

    /* Image Input Styling */
.image-input-container {
    margin-bottom: 15px;
}

input[type="file"] {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f4f7f8;
    transition: all 0.3s ease;
    cursor: pointer;
}

input[type="file"]:hover {
    background-color: #e9ecef;
}

input[type="file"]:focus {
    border-color: #007bff;
    background-color: #fff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
}

</style>

<div class="form-container">
    <h2>Modifier le produit</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('produit.mettreajour', $produit->id_produit) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nom">Nom de l'article:</label>
            <input type="text" id="nom" name="nom" value="{{ $produit->nom }}" required>
        </div>
        <div class="form-group">
            <label for="quantité_actual">Quantité:</label>
            <input type="number" id="quantité_actual" name="quantité_actual" value="{{ $produit->quantité_actual }}" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix unitaire:</label>
            <input type="number" id="prix" name="prix" value="{{ $produit->prix }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" name="description">{{ $produit->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image du produit:</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>
        <button type="submit">Mettre à jour</button>
    </form>

    <a href="{{ route('produits') }}">Retour à la liste des produits</a>
</div>

@endsection

@extends('admin/layouts/model_page')

@section('titre')
profile
@endsection

@section('page')
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mon Profil</title>
  <style>
        .profile-wrapper {
      margin:auto;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
      padding: 30px;
      text-align: center;
    }

    .profile-header {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 30px;
    }

    .profile-header img {
      border-radius: 50%;
      width: 100px;
      height: 100px;
      object-fit: cover;
      margin-bottom: 20px;
    }

    .profile-header h2 {
      margin: 0;
      font-size: 24px;
      color: #333;
    }

    .profile-header p {
      margin: 5px 0;
      font-size: 16px;
      color: #777;
    }

    .profile-info {
      text-align: left;
    }

    .profile-info p {
      font-size: 16px;
      margin: 8px 0;
      color: #333;
    }

    .profile-info span {
      font-weight: bold;
      color: #555;
    }

    .btn-edit-profile {
      background-color: #f9a134;
      border: none;
      color: white;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
      transition: background-color 0.3s ease;
    }

    .btn-edit-profile:hover {
      background-color: #e08d2d;
    }

    /* Form styling */
    .form-edit-profile {
      display: none;
      text-align: left;
    }

    .form-edit-profile input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    .form-edit-profile button {
      background-color: #2697ff;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
      transition: background-color 0.3s ease;
    }

    .form-edit-profile button:hover {
      background-color: #1a78d8;
    }

    .error-message {
      color: red;
      font-size: 14px;
      margin-top: -10px;
    }

    /* Media Queries */
    @media (max-width: 768px) {
      .profile-wrapper {
        padding: 20px;
      }

      .profile-header h2 {
        font-size: 20px;
      }

      .profile-header img {
        width: 80px;
        height: 80px;
      }

      .btn-edit-profile, .form-edit-profile button {
        font-size: 14px;
        padding: 8px 16px;
      }
    }
  </style>
</head>
<body>
  <div class="profile-wrapper">
    <!-- Profile Header -->
    <div class="profile-header">
      <h2 id="userName">{{$user->nom." ".$user->prenom}}</h2>
      <p id="Email">{{$user->email}}</p>
    </div>

    <!-- Profile Information Display -->
    <div class="profile-info">
      <p><span>Nom :</span> <span id="nom">{{$user->nom}}</span></p>
      <p><span>Prenom :</span> <span id="prenom">{{$user->prenom}}</span></p>
      <p><span>Adresse e-mail :</span> <span id="userDisplayEmailDetail">{{$user->email}}</span></p>
      
    </div>

    <button class="btn-edit-profile" onclick="toggleEditForm()">Modifier le Profil</button>

    <!-- Profile Edit Form -->
    <div class="form-edit-profile" id="editProfileForm">
      <form id="userEditForm" method="POST" action="{{route('profil.modifier')}}">
        @csrf
        @method('PUT')
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="{{$user->nom}}">

        <label for="prenom">Prenom :</label>
        <input type="text" id="prenom" name="prenom" value="{{$user->prenom}}">

        <label for="email">Adresse e-mail :</label>
        <input type="email" id="email" name="email" value="{{$user->email}}">

        <!-- Ajouter les champs pour modifier le mot de passe -->
        <label for="password">Nouveau mot de passe :</label>
        <input type="password" id="password" name="password" placeholder="Nouveau mot de passe">

        <label for="password_confirmation">Confirmer le mot de passe :</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmer le mot de passe">

        <div id="passwordErrorMessage" class="error-message"></div>

        <button type="submit">Enregistrer</button>
      </form>
    </div>
  </div>

  <script>
    // Fonction pour basculer entre la vue normale et l'édition
    function toggleEditForm() {
      const profileInfo = document.querySelector('.profile-info');
      const editForm = document.getElementById('editProfileForm');
      const editButton = document.querySelector('.btn-edit-profile');

      if (editForm.style.display === 'none' || editForm.style.display === '') {
        editForm.style.display = 'block';
        profileInfo.style.display = 'none';
        editButton.textContent = 'Annuler';
      } else {
        editForm.style.display = 'none';
        profileInfo.style.display = 'block';
        editButton.textContent = 'Modifier le Profil';
      }
    }
  </script>
</body>
</html>
@endsection

@extends('layouts/model_page_user')
@section('title')
    profile
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection
@section('contenu')

<section id="page-header">
    <h2>Mon Profil</h2>
</section>

<section class="section-p1">
    <div class="profile-container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="profile-header">
            <div class="profile-image">
                @if($user->image)
                    <img src="{{ asset($user->image) }}" alt="Profile Image">
                @else
                    <img src="{{ asset('img/default-profile.png') }}" alt="Default Profile">
                @endif
            </div>
            <div class="profile-info">
                <h3>{{ $user->name }}</h3>
                <p>{{ $user->email }}</p>
                @if($user->status)
                    <span class="status-badge">{{ $user->status }}</span>
                @endif
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="image">Photo de profil</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">Nom d'utilisateur</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $user->nom) }}">
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $user->prenom) }}">
            </div>

            <div class="form-group">
                <label for="service">Service</label>
                <select name="service" id="service">
                    <option value="">Sélectionnez un service</option>
                    <option value="informatique" {{ $user->service == 'informatique' ? 'selected' : '' }}>Informatique</option>
                    <option value="rh" {{ $user->service == 'rh' ? 'selected' : '' }}>Ressources Humaines</option>
                    <option value="comptabilite" {{ $user->service == 'comptabilite' ? 'selected' : '' }}>Comptabilité</option>
                    <option value="commercial" {{ $user->service == 'commercial' ? 'selected' : '' }}>Commercial</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Statut</label>
                <select name="status" id="status">
                    <option value="">Sélectionnez un statut</option>
                    <option value="actif" {{ $user->status == 'actif' ? 'selected' : '' }}>Actif</option>
                    <option value="inactif" {{ $user->status == 'inactif' ? 'selected' : '' }}>Inactif</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="normal">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</section>

@endsection
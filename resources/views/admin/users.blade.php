@extends('admin/layouts.model_page')

@section('titre', 'Gestion des utilisateurs')

@section('page')

<style>
    /* ... (styles inchangés) ... */
    .container {
        
        max-width: 1000px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    form div {
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="email"], input[type="password"] {
        padding: 10px;
        font-size: 1rem;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
        width: 100%;
    }

    button {
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #218838;
    }
    .list{
        overflow-x: auto;
    }

    table {
        
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    td button {
        background-color: #dc3545;
        border: none;
        padding: 8px 12px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    td button:hover {
        background-color: #c82333;
    }


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
    border-radius: 5px;
    width: 80%;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.modal-buttons {
    margin-top: 20px;
}

.btn-danger {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.btn-danger:hover, .btn-secondary:hover {
    opacity: 0.8;
}
</style>

<div class="container">
    <h1>Gestion des utilisateurs</h1>

    <!-- Formulaire d'ajout d'utilisateur -->
    <form method="POST" action="{{ route('admin.users.create') }}">
        @csrf
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div>
            <label for="name">Nom d'utilisateur :</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirmer le mot de passe :</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit">Ajouter un utilisateur</button>
    </form>
</div>

<div class="container">
    <!-- Liste des utilisateurs -->
    <h2>Liste des utilisateurs</h2>
    <div class="list">
    
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->nom }}</td>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <h2>Confirmer la suppression</h2>
            <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="btn-danger">Supprimer</button>
                <button id="cancelDelete" class="btn-secondary">Annuler</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('confirmModal');
        const deleteButtons = document.querySelectorAll('.delete-form .btn-delete');
        const confirmDelete = document.getElementById('confirmDelete');
        const cancelDelete = document.getElementById('cancelDelete');
        let currentForm;
    
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                currentForm = this.closest('.delete-form');
                modal.style.display = 'block';
            });
        });
    
        confirmDelete.addEventListener('click', function() {
            if (currentForm) {
                currentForm.submit();
            }
            modal.style.display = 'none';
        });
    
        cancelDelete.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>
@endsection
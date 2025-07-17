@extends('admin/layouts/model_page')
@section('titre')
Gestion des Commandes
@endsection

@section('page')
<div class="overview-boxes">
    <!-- Commandes en attente -->
    <div class="box">
        <div class="right-side">
            <div class="box-topic">Commandes en Attente</div>
            <div class="number">{{ $commandesEnAttente }}</div>
            <div class="indicator">
                <i class="bx bx-time"></i>
                <span class="text">À traiter</span>
            </div>
        </div>
        <i class="bx bx-loader-circle cart"></i>
    </div>
    <!-- Commandes validées -->
    <div class="box">
        <div class="right-side">
            <div class="box-topic">Commandes Validées</div>
            <div class="number">{{ $commandesValidees }}</div>
            <div class="indicator">
                <i class="bx bx-check"></i>
                <span class="text">Validées</span>
            </div>
        </div>
        <i class="bx bx-check-circle cart two"></i>
    </div>
    <!-- Commandes refusées -->
    <div class="box">
        <div class="right-side">
            <div class="box-topic">Commandes Refusées</div>
            <div class="number">{{ $commandesRefusees }}</div>
            <div class="indicator">
                <i class="bx bx-x"></i>
                <span class="text">Refusées</span>
            </div>
        </div>
        <i class="bx bx-x-circle cart three"></i>
    </div>
</div>

<div class="sales-boxes">
    <div class="product-list">
        <h2>Commandes en Attente de Validation</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Commande</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Détails</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                @if($commande->status == 'en attente')
                <tr>
                    <td>#{{$commande->id}}</td>
                    <td>{{$commande->client->nom}}</td>
                    <td>{{$commande->date_creation}}</td>
                    <td>
                        <button class="btn-details" onclick="toggleDetails({{$commande->id}})">
                            Voir détails
                        </button>
                    </td>
                    <td>
                        <span class="status-badge status-pending">En attente</span>
                    </td>
                    <td class="actions">
                        <form action="{{ route('commandes.valider', $commande->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-validate">
                                <i class="bx bx-check"></i> Valider
                            </button>
                        </form>
                        <form action="{{ route('commandes.refuser', $commande->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-reject">
                                <i class="bx bx-x"></i> Refuser
                            </button>
                        </form>
                    </td>
                </tr>
                <!-- Ligne de détails cachée par défaut -->
                <tr id="details-{{$commande->id}}" class="details-row" style="display: none;">
                    <td colspan="6">
                        <div class="commande-details">
                            <h4>Détails de la commande #{{$commande->id}}</h4>
                            <table class="details-table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Quantité</th>
                                        <th>Prix unitaire</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commande->details as $detail)
                                    <tr>
                                        <td>{{$detail->produit->nom}}</td>
                                        <td>{{$detail->quantité}}</td>
                                        <td>{{$detail->produit->prix}} MAD</td>
                                        <td>{{$detail->quantité * $detail->produit->prix}} MAD</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
.status-badge {
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 0.9em;
    font-weight: 600;
}

.status-pending {
    background-color: #ffd700;
    color: #000;
}

.btn-validate, .btn-reject {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 0 5px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-validate {
    background-color: #4CAF50;
    color: white;
}

.btn-reject {
    background-color: #f44336;
    color: white;
}

.btn-details {
    background-color: #2196F3;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.details-row {
    background-color: #f9f9f9;
}

.commande-details {
    padding: 15px;
}

.details-table {
    width: 100%;
    margin-top: 10px;
    border-collapse: collapse;
}

.details-table th,
.details-table td {
    padding: 8px;
    border: 1px solid #ddd;
    text-align: left;
}

.actions {
    display: flex;
    gap: 5px;
    justify-content: center;
}

/* Style pour les box d'aperçu */
.overview-boxes {
    display: flex;
    justify-content: space-between;
    padding: 20px;
    flex-wrap: wrap;
    gap: 20px;
}

.box {
    flex: 1;
    min-width: 250px;
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>

<script>
function toggleDetails(commandeId) {
    const detailsRow = document.getElementById(`details-${commandeId}`);
    if (detailsRow.style.display === 'none') {
        detailsRow.style.display = 'table-row';
    } else {
        detailsRow.style.display = 'none';
    }
}
</script>
@endsection
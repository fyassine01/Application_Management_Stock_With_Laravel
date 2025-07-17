@extends('layouts/model_page_user')
@section('title')
    commandes
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/commandes.css') }}">
@endsection
@section('contenu')

        <section id="page-header">
            <h2>#Mes Commandes</h2>
            <p>Suivez l'état de vos commandes</p>
        </section>
        
        <section class="section-p1">
            <div class="orders-container">
                <div class="page-title">
                    <h2>Suivi des Commandes</h2>
                </div>
        
                <div class="orders-grid">
                    @foreach($commandes as $commande)
                    <div class="order-card">
                        <div class="order-header">
                            <span class="order-number">{{ $commande['numero'] }}</span>
                            <span class="order-status status-{{ Str::slug($commande['status']) }}">
                                {{ $commande['status'] }}
                            </span>
                        </div>
                        
                        <div class="order-details">
                            <div class="detail-item">
                                <span class="detail-label">Date de commande</span>
                                <span class="detail-value">{{ \Carbon\Carbon::parse($commande['date_commande'])->format('d M Y') }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Total</span>
                                <span class="detail-value">{{ number_format($commande['total'], 2) }} DH</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Articles</span>
                                <span class="detail-value">{{ $commande['nombre_produits'] }} produits</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">
                                    @if($commande['status'] === 'Livrée')
                                        Livrée le
                                    @else
                                        Livraison prévue
                                    @endif
                                </span>
                                <span class="detail-value">{{ \Carbon\Carbon::parse($commande['date_livraison'])->format('d M Y') }}</span>
                            </div>
                        </div>
        
                        <div class="order-products">
                            @foreach($commande['details'] as $detail)
                            <div class="product-item">
                                <img src="{{  asset('storage/' .$detail['produit']->image) }}" alt="{{ $detail['produit']->nom }}" class="product-image">
                                <div class="product-details">
                                    <div class="product-name">{{ $detail['produit']->nom }}</div>
                                    <div class="product-price">
                                        {{ number_format($detail['prix_unitaire'], 2) }} DH x {{ $detail['quantité'] }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

@endsection
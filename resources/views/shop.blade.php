@extends('layouts/model_page_user')
@section('title')
    shop
@endsection
@section('contenu')
    <section id="page-header">
        <h2>#Bienvenu</h2>
        <!--<p>Save more with coupons & up to 70% off!</p>-->
    </section>

    <section id="product1" class="section-p1">

        <!--<div class="search-container">
            <input type="text" id="search-input" placeholder="Rechercher des produits...">
            <i class="fas fa-search" id="search-icon"></i>
        </div>-->

        <form action="{{ route('search') }}" method="GET" class="search-container">
            <input 
                type="text" 
                name="q" 
                id="search-input" 
                placeholder="Rechercher des produits..." 
                value="{{ $searchTerm ?? '' }}"
            >
            <button type="submit" class="search-button">
                <i class="fas fa-search" id="search-icon"></i>
            </button>
        </form>



        <div class="pro-container">
           <!-- <div class="pro" onclick="window.location.href='singleProduct.html';">
                <img src="images/products/f1.jpg" alt="">
                <div class="des">
                    <span>adidas</span>
                    <h5>Cartoon Astronaut T-Shirts</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$78</h4>
                </div>
                <a href="#"><i class="fas fa-shopping-cart cart"></i></a>
            </div>-->
            @foreach ($produits as $produit)

            <div class="pro" data-product-id="{{ $produit->id_produit }}" data-stock="{{ $produit->quantité_actual }}">
                <img src="{{ asset('storage/' . $produit->image) }}" alt="">
                <div class="des">
                    <h5>{{$produit->nom}}</h5>
                    <span>{{$produit->description}}</span>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>{{$produit->prix}} DH</h4>
                </div>
                <a class="add-to-cart"><i class="fas fa-shopping-cart cart"></i></a>
            </div>
                
            @endforeach


        </div>

    </section>

  <!--  <section id="pagination" class="section-p1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="fas fa-long-arrow-alt-right"></i></a>
    </section>-->

    <section id="product1" class="section-p1">
    </section>

    <section id="pagination" class="section-p1">
        {{ $produits->links() }}
    </section>
@endsection

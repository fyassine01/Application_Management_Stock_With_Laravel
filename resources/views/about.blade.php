@extends('layouts/model_page_user')
@section('styles')
<style>
    .about-hero {
        background-color: #f4f4f4;
        padding: 100px 0;
        text-align: center;
        margin-bottom: 60px;
        background-image: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), url('/api/placeholder/1920/500');
        background-size: cover;
        background-position: center;
    }
    
    .about-hero h1 {
        font-size: 3rem;
        color: #1a1a1a;
        margin-bottom: 20px;
        font-weight: 800;
    }
    
    .about-hero p {
        color: #666;
        font-size: 1.2rem;
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.6;
    }
    
    .about-section {
        padding: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        margin: 60px 0;
    }
    
    .feature-card {
        text-align: center;
        padding: 30px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
        background: #fff;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    }
    
    .feature-card i {
        font-size: 2.5rem;
        color: #088178;
        margin-bottom: 20px;
    }
    
    .feature-card h3 {
        font-size: 1.2rem;
        margin-bottom: 15px;
        color: #1a1a1a;
    }
    
    .feature-card p {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.6;
    }
    
    .about-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: center;
        margin: 80px 0;
    }
    
    .about-content img {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    }
    
    .about-text {
        padding: 20px;
    }
    
    .about-text h2 {
        font-size: 2rem;
        color: #1a1a1a;
        margin-bottom: 25px;
    }
    
    .about-text p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 20px;
    }
    
    .stats-section {
        background-color: #088178;
        color: white;
        padding: 60px 0;
        margin: 60px 0;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
    }
    
    .testimonials {
        padding: 60px 0;
        background: #f9f9f9;
    }
    
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .testimonial-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    }
    
    .testimonial-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .testimonial-header img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin-right: 15px;
    }
    
    .testimonial-author h4 {
        margin: 0;
        color: #1a1a1a;
    }
    
    .testimonial-author p {
        margin: 5px 0 0;
        color: #666;
        font-size: 0.9rem;
    }
    
    .testimonial-text {
        color: #666;
        line-height: 1.6;
        font-style: italic;
    }
    
    .testimonial-rating {
        color: #ffd700;
        margin-top: 15px;
    }
    
    @media (max-width: 1024px) {
        .features-grid,
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .testimonials-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .about-hero h1 {
            font-size: 2.5rem;
        }
        
        .about-content {
            grid-template-columns: 1fr;
        }
        
        .testimonials-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 480px) {
        .features-grid,
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .about-section {
            padding: 20px;
        }
        
        .about-hero {
            padding: 60px 0;
        }
    }
    </style>
@endsection

@section('contenu')
    
    <div class="about-hero">
        <h1>Votre Boutique de Confiance</h1>
        <p>Découvrez une expérience shopping unique avec une large sélection de produits de qualité et un service client exceptionnel.</p>
    </div>
    
    <section class="about-section">
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-shipping-fast"></i>
                <h3>Livraison Rapide</h3>
                <p>Livraison gratuite sous 24-48h partout au Maroc pour toute commande.</p>
            </div>
            
            <div class="feature-card">
                <i class="fas fa-shield-alt"></i>
                <h3>Paiement Sécurisé</h3>
                <p>Transactions sécurisées avec cryptage SSL et multiples options de paiement.</p>
            </div>
            
            <div class="feature-card">
                <i class="fas fa-undo"></i>
                <h3>Retours Gratuits</h3>
                <p>Satisfait ou remboursé sous 30 jours, retours sans condition.</p>
            </div>
            
            <div class="feature-card">
                <i class="fas fa-headset"></i>
                <h3>Support 24/7</h3>
                <p>Une équipe dédiée à votre service pour répondre à toutes vos questions.</p>
            </div>
        </div>
    
        <div class="about-content">
            <img src="{{ asset('img/ensab1.png') }}" alt="Notre Histoire">
            <div class="about-text">
                <h2>Notre Histoire</h2>
                <p>Fondée avec la vision de révolutionner l'expérience shopping en ligne, notre boutique s'est rapidement imposée comme une référence dans le e-commerce au Maroc. Notre engagement envers la qualité et la satisfaction client nous a permis de gagner la confiance de milliers de clients.</p>
                <p>Nous collaborons directement avec les meilleurs fabricants et marques pour vous offrir une sélection premium de produits à des prix compétitifs. Notre plateforme est constamment mise à jour pour vous offrir une expérience d'achat fluide et agréable.</p>
            </div>
        </div>
    <!--
    
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">10K+</div>
                    <div class="stat-label">Clients Satisfaits</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">5000+</div>
                    <div class="stat-label">Produits</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">99%</div>
                    <div class="stat-label">Avis Positifs</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support Client</div>
                </div>
            </div>
        </div>
    -->
    <!--
        <div class="testimonials">
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="/api/placeholder/60/60" alt="Client 1">
                        <div class="testimonial-author">
                            <h4>Sarah Benani</h4>
                            <p>Cliente Fidèle</p>
                        </div>
                    </div>
                    <p class="testimonial-text">"Service exceptionnel ! La qualité des produits et la rapidité de livraison m'ont vraiment impressionnée. Je recommande vivement !"</p>
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
    
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="/api/placeholder/60/60" alt="Client 2">
                        <div class="testimonial-author">
                            <h4>Karim Alami</h4>
                            <p>Client Régulier</p>
                        </div>
                    </div>
                    <p class="testimonial-text">"Des prix compétitifs et un service client réactif. Ma boutique en ligne préférée pour tous mes achats !"</p>
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
    
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="/api/placeholder/60/60" alt="Client 3">
                        <div class="testimonial-author">
                            <h4>Leila Chakiri</h4>
                            <p>Nouvelle Cliente</p>
                        </div>
                    </div>
                    <p class="testimonial-text">"Première commande et je suis conquise ! Interface intuitive et livraison ultra rapide. Je reviendrai !"</p>
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    -->
    </section>
@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>

    <!-- font-awesome cdn link -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <!-- custom css file link -->
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-pagination.css') }}">

</head>

<body>

    <section id="header">
        <a href="#"><img src="{{ asset('img/logo-ensa-berrechid.png') }}" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <!--
                <li><a href="index.html">Home</a></li>
                -->
                <li><a class="{{ Request::routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">Shop</a></li>
                <li><a class="{{ Request::routeIs('profile.index') ? 'active' : '' }}" href="{{ route('profile.index') }}">Profil</a></li>
                <li><a class="{{ Request::routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                <li><a class="{{ Request::routeIs('commandes.index') ? 'active' : '' }}" href="{{ route('commandes.index') }}">Mes Commandes</a></li>
                <li class="logout-container">
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            Déconnexion
                        </button>
                    </form>
                </li>
                <li id="lg-bag"><a id="cart-toggle"><i class="far fa-shopping-bag"></i></a></li>
                <a id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a id="mobile-cart-toggle"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>


    </section>

    <!-- shop.blade.php (Cart Modal) -->
    <div id="cartModal" class="cart-modal">
        <div class="cart-content">
            <div class="cart-header">
                <h3>CART LIST</h3>
                <button id="close-cart" class="close-cart">×</button>
            </div>
            <div class="cart-items">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th></th> <!-- For remove button -->
                        </tr>
                    </thead>
                    <tbody id="cartItemsBody">
                    <!-- Cart items will be added here -->
                    </tbody>
                </table>

            </div>
            <div class="cart-total">
                TOTAL: <span id="cartTotal">0</span>
            </div>
            <div class="cart-footer">
                <button id="close-btn" class="close-btn">Close</button>
                <button id="checkout-btn" class="checkout-btn">Submit Order</button>
            </div>
        </div>
    </div>

    <!-- Cart Icon -->
    <!--<div id="cart-icon" class="cart-toggle">
        <i class="far fa-shopping-bag"></i>
        <span id="cart-count">0</span> 
    </div>
    <div class="cart-modal" id="cartModal">
        <div class="cart-content">
            <div class="cart-header">
                <h3>CART LIST</h3>
                <button class="close-cart">×</button>
            </div>
            <div class="cart-items">
                <table id="cartItemsBody"></table>
            </div>
            <div class="cart-total">
                TOTAL: <span id="cartTotal">0</span>
            </div>
            <div class="cart-footer">
                <button class="close-btn">Close</button>
                <button class="checkout-btn">Proceed to Checkout</button>
                <button class="edit-cart-btn">Edit Cart</button>
            </div>
        </div>
    </div> -->

    @yield('contenu')


    <footer>
        <div class="footer-container">
            <div class="footer-section about">
                <h3>À propos de nous</h3>
                <p>Votre description d'entreprise concise et engageante ici. Mettez en avant votre mission et vos valeurs.</p>
            </div>
            <div class="footer-section links">
                <h3>Liens utiles</h3>
                <ul>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{{ route('profile.index') }}">Profil</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="{{ route('commandes.index') }}">Mes Commandes</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h3>Contactez-nous</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Rue de l'Exemple, Ville, Pays</p>
                <p><i class="fas fa-phone"></i> +12 345 678 90</p>
                <p><i class="fas fa-envelope"></i> info@example.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2023 ENSA Berrchid. Tous droits réservés.</p>
         </div>

    </footer>





    <!-- javascript script file link -->
 
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
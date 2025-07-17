
const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');

if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    });
}

if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    });
}

// Cart functionality
const cartToggle = document.getElementById('cart-toggle');
const mobileCartToggle = document.getElementById('mobile-cart-toggle');
const cartModal = document.getElementById('cartModal');
const closeCart = document.getElementById('close-cart');
const closeBtn = document.getElementById('close-btn');
const checkoutBtn = document.getElementById('checkout-btn');
const cartItemsBody = document.getElementById('cartItemsBody'); // Correct element
const cartTotalElement = document.getElementById('cartTotal');

let cartItems = [];


// Toggle cart modal
function toggleCart() {
    cartModal.classList.toggle('active');
    updateCartDisplay(); // Update display whenever modal is toggled
}

// Close cart modal
function closeCartModal() {
    cartModal.classList.remove('active');
}

// Update cart display (corrected and improved)
function updateCartDisplay() {
    cartItemsBody.innerHTML = '';
    let cartTotal = 0;

    cartItems.forEach((item, index) => {
        const row = cartItemsBody.insertRow();
        const nameCell = row.insertCell();
        const quantityCell = row.insertCell();
        const priceCell = row.insertCell();
        const removeCell = row.insertCell();

        nameCell.textContent = item.name;


        const quantityInput = document.createElement('input');
        quantityInput.type = 'number';
        quantityInput.value = item.quantity;
        quantityInput.min = 1;
        quantityInput.max = item.stock;
        quantityInput.addEventListener('change', () => {
            item.quantity = parseInt(quantityInput.value) || 1; // Ensure quantity is at least 1
            const newQuantity = parseInt(quantityInput.value) || 1;
            // Vérifier si la nouvelle quantité dépasse le stock
            if (newQuantity > item.stock) {
                alert(`Désolé, il n'y a que ${item.stock} unités disponibles en stock.`);
                quantityInput.value = item.stock;
                item.quantity = item.stock;
            } else {
                item.quantity = newQuantity;
            }

            updateCartDisplay(); 
            saveCartToLocalStorage();
            
        });
        quantityCell.appendChild(quantityInput);


        const itemTotal = item.price * item.quantity;
        priceCell.textContent = itemTotal.toFixed(2) + " DH";
        cartTotal += itemTotal;

        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', () => removeFromCart(index));
        removeCell.appendChild(removeButton);
    });

    cartTotalElement.textContent = cartTotal.toFixed(2) + " DH";
}

// Add item to cart (improved)
function addToCart(item) {
    const existingItemIndex = cartItems.findIndex(cartItem => cartItem.name === item.name);

    if (existingItemIndex > -1) {
        // Vérifier si l'ajout dépasserait le stock disponible
        const newQuantity = cartItems[existingItemIndex].quantity + 1;
        if (newQuantity > item.stock) {
            alert(`Désolé, il n'y a que ${item.stock} unités disponibles en stock.`);
            return;
        }
        cartItems[existingItemIndex].quantity += 1;
    } else {
        cartItems.push({ ...item, quantity: 1 });
    }

    updateCartDisplay();
    saveCartToLocalStorage();
}

// Remove item from cart
function removeFromCart(index) {
    cartItems.splice(index, 1);
    updateCartDisplay();
    saveCartToLocalStorage();
}



// Event listeners for cart
cartToggle.addEventListener('click', toggleCart);
mobileCartToggle.addEventListener('click', toggleCart);
closeCart.addEventListener('click', closeCartModal);
closeBtn.addEventListener('click', closeCartModal);
/*
checkoutBtn.addEventListener('click', () => {
   // Example: Send cart data to server or another page
    console.log("Items in cart:", cartItems);
    alert("Submitting order...\n(Check the console for cart data)");


});
*/

// ... (le reste du code reste inchangé)

checkoutBtn.addEventListener('click', () => {
    if (cartItems.length === 0) {
        alert("Votre panier est vide. Veuillez ajouter des articles avant de passer commande.");
        return;
    }
    const orderData = {
        items: cartItems.map(item => ({
            nom: item.name, // Envoi du nom du produit au lieu de l'ID
            quantité: item.quantity,
            prix: item.prix
        })),
        total: parseFloat(cartTotalElement.textContent.replace(/[^\d.]/g, ''))
    };

    // Envoyer les données au serveur
    fetch('/shop/create-order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(orderData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Commande passée avec succès !");
            // Vider le panier et mettre à jour l'affichage
            cartItems = [];
            updateCartDisplay();
            saveCartToLocalStorage();
        } else {
            alert("Erreur lors de la création de la commande : " + data.message);
            console.error(data.error);
        }
    })
    .catch(error => {
        alert("Une erreur s'est produite : " + error);
        console.error(error);
    });
});

// ... (le reste du code reste inchangé)


/*
window.addEventListener('click', (event) => {
    if (event.target === cartModal) {
        closeCartModal();
    }
});
*/



// Product click event listeners (using event delegation)
const productContainer = document.querySelector('.pro-container');

productContainer.addEventListener('click', (event) => {
    if (event.target.classList.contains('cart')) {
        const productElement = event.target.closest('.pro');

        const productName = productElement.querySelector('.des h5').textContent;
        const productPriceString = productElement.querySelector('.des h4').textContent;
        const productStock = parseInt(productElement.dataset.stock); // Récupérer le stock depuis l'attribut data-stock

        const productPrice = parseFloat(productPriceString.replace(/[^\d.]/g, ''));


        if (!isNaN(productPrice) && !isNaN(productStock)) {
            addToCart({ name: productName, price: productPrice,  stock: productStock });
            //toggleCart(); //open cart modal after clicking product
            saveCartToLocalStorage();
        } else {
            console.error("Error parsing product price:", productPriceString);
        }
    }
});


// Function to save cart to local storage
function saveCartToLocalStorage() {
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
}

// Function to load cart from local storage
function loadCartFromLocalStorage() {
    const storedCart = localStorage.getItem('cartItems');
    if (storedCart) {
        cartItems = JSON.parse(storedCart);
        updateCartDisplay(); // Update display after loading
    }
}

loadCartFromLocalStorage();
//////////////////////////////////////

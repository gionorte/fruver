let cart = [];

function updateCartDisplay(cart) {
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const cartCount = document.getElementById('cart-count');
    cartItems.innerHTML = '';
    let total = 0;
    let count = 0;

    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        count += item.quantity;
        cartItems.innerHTML += `
            <div class="cart-item">
                <span>${item.product} x ${item.quantity}</span>
                <span>$${itemTotal}</span>
                <button onclick="removeFromCart('${item.product}')">Eliminar</button>
            </div>
        `;
    });

    cartTotal.innerText = total;
    cartCount.innerText = count;
}

function addToCart(product, price) {
    const formData = new FormData();
    formData.append('action', 'add');
    formData.append('product', product);
    formData.append('price', price);

    fetch('cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        cart = data;
        updateCartDisplay(cart);
    });
}

function removeFromCart(product) {
    const formData = new FormData();
    formData.append('action', 'remove');
    formData.append('product', product);

    fetch('cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        cart = data;
        updateCartDisplay(cart);
    });
}

function clearCart() {
    const formData = new FormData();
    formData.append('action', 'clear');

    fetch('cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        cart = data;
        updateCartDisplay(cart);
    });
}

function toggleCart() {
    const cartContainer = document.getElementById('cart-container');
    cartContainer.style.display = cartContainer.style.display === 'block' ? 'none' : 'block';
}

document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', () => {
        const product = button.getAttribute('data-product');
        const price = button.getAttribute('data-price');
        addToCart(product, price);
    });
});

// JavaScript para el carrusel de imágenes
const images = document.querySelectorAll('.carousel img');
let index = 0;

function nextImage() {
    images[index].classList.remove('active');
    index = (index + 1) % images.length;
    images[index].classList.add('active');
}

setInterval(nextImage, 3000); // Cambia la imagen cada 3 segundos

// JavaScript para alternar la visualización del menú en dispositivos móviles
const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
const navbar = document.getElementById('navbar');

mobileNavToggle.addEventListener('click', () => {
    navbar.classList.toggle('active');
});

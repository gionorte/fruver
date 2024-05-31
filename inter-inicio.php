<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut</title>
    <link href="img/icon-p.png" rel="icon">
    <link rel="stylesheet" href="css/inter-in.css">
    <style>
        .cart-container {
            position: fixed;
            top: 50px;
            right: 20px;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            display: none;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .cart-item button {
            background: orange;
            color: white;
            border: none;
            cursor: pointer;
        }
        .cart-total {
            font-weight: bold;
        }
        .show-cart {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
        .cart-icon {
            position: relative;
            cursor: pointer;
            display: inline-block;
            margin-left: 20px; /* Adjust the margin as needed */
        }
        .cart-icon img {
            width: 40px;
        }
        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background: orange;
            color: white;
            border-radius: 50%;
            padding: 5px;
            font-size: 12px;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar ul {
            display: flex;
            list-style: none;
        }
        .navbar ul li {
            margin-left: 20px;
        }
        .profile-container {
            position: fixed;
            top: 50px;
            right: 20px;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            display: none;
        }
        .profile-icon {
            position: relative;
            cursor: pointer;
            display: inline-block;
            margin-left: 20px; /* Ajusta el margen según sea necesario */
        }
        .profile-icon img {
            width: 40px;
        }
    </style>
</head>
<body>
    <main id="hero">
        <header>
            <div class="logo">
                <h1 class="logo"><a href="inter-inicio.php"><img src="img/icono.png" alt="icon" style="width: 60px;"></a></h1>
            </div>
            <h2 class="eri">INZUFRUT</h2>
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope-fill"></i><a href="mailto:contact@example.com">inzufruts.a.s@outlook.es</a>
                <i class="bi bi-phone-fill phone-icon"></i> <a href=""> +57 320 778 5187 </a>
            </div>
            <i class="bi bi-list mobile-nav-toggle"></i> <!-- Icono de menú para dispositivos móviles -->
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="btn-get-started scrollto" href="inter-inicio.php">Inicio</a></li>
                    <li><a class="btn-get-started scrollto" href="#">Productos</a></li>
                    <li><a class="btn-get-started scrollto" href="contactanos.php">Contactanos</a></li>
                    <li><a class="btn-get-started scrollto" href="registro_cliente.php">Registrate</a></li>
                </ul>
                <div class="cart-icon" onclick="toggleCart()">
                    <img src="img/cart.png" alt="Cart Icon">
                    <span class="cart-count" id="cart-count">0</span>
                </div>
                <div class="profile-icon" onclick="toggleProfile()">
                    <img src="img/usuario.png" alt="Profile Icon">
                </div>
            </nav>
        </header>

        <video autoplay muted loop>
            <source src="videos/ini-inter.mp4" type="video/mp4">
        </video>
        <div class="capa"></div>

        <section>
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
                <h1>BIENVENIDO A INZUFRUT</h1>
                <h2>Si eres parte de esta familia inicia sesion</h2>
                <a href="iniciosesion.php" class="btn-get-started scrollto">INCIAR SESION</a>
            </div>
        </section>
    </main>

    <h2 class="titulo">Nuestros productos</h2>    

    <section class="produc-vista">
        
        <div class="product">
            <img src="img/manzana.jpg" alt="Manzana">
            <h3>Manzana</h3>
            <p>La manzana es una fruta deliciosa y nutritiva, rica en fibra y antioxidantes.</p>
            <p><strong>Precio:</strong> $5.000 k</p>
            <button class="add-to-cart" data-product="Manzana" data-price="5000">Agregar al Carrito</button>
        </div>
        <div class="product">
            <img src="img/naranja.jpg" alt="Naranja">
            <h3>Naranja</h3>
            <p>La naranja es una excelente fuente de vitamina C y es perfecta para preparar jugos frescos.</p>
            <p><strong>Precio:</strong> $4.000 k</p>
            <button class="add-to-cart" data-product="Naranja" data-price="4000">Agregar al Carrito</button>
        </div>
        <div class="product">
            <img src="img/uva.jpg" alt="Uva">
            <h3>Uva</h3>
            <p>Las uvas son pequeñas bombas de energía, ideales para un refrigerio saludable o para acompañar postres.</p>
            <p><strong>Precio:</strong> $6.000 k</p>
            <button class="add-to-cart" data-product="Uva" data-price="6000">Agregar al Carrito</button>
        </div>
    </section>

    <div class="cart-container" id="cart-container">
        <h2>Carrito de Compras</h2>
        <div id="cart-items"></div>
        <p class="cart-total">Total: $<span id="cart-total">0</span></p>
        <button onclick="clearCart()">Vaciar Carrito</button>
    </div>

  <div class="profile-container" id="profile-container">
        <h2>Perfil del Cliente</h2>
        <div id="profile-data">
            <!-- Datos del cliente se insertarán aquí -->
        </div>
        <button onclick="editProfile()">Editar Perfil</button>
    </div>

    <footer>
        <p>Dirección: Calle Ficticia #123, Ciudad Imaginaria</p>
        <p>Todos los derechos reservados &copy; 2024 Inzufrut</p>
        <div class="social-icons">
            <a href="" target="_blank"><img src="img/facebook.png" alt="Facebook"></a>
            <a href="" target="_blank"><img src="img/instagram.png" alt="Instagram"></a>
            <a href="" target="_blank"><img src="img/twitter.png" alt="Twitter"></a>
            <a href="" target="_blank"><img src="img/youtube.png" alt="YouTube"></a>
        </div>
        <div class="logo-ft">
            <h1 class="logo"><a href="inter-inicio.php"><img src="img/icono.png" alt="icon" style="width: 60px;"></a></h1>
        </div>
        <p class="show-cart" onclick="toggleCart()">Ver Carrito</p>
    </footer>
    <script>
        async function fetchProfileData() {
            try {
                const response = await fetch('get_cliente.php');
                const data = await response.json();
                if (data.error) {
                    document.getElementById('profile-data').innerHTML = `<p>${data.error}</p>`;
                } else {
                    document.getElementById('profile-data').innerHTML = `
                        <p><strong>Número de Documento:</strong> ${data.Num_Doc}</p>
                        <p><strong>Tipo de Documento:</strong> ${data.Tipo_Doc}</p>
                        <p><strong>Primer Nombre:</strong> ${data.Prim_Nombre}</p>
                        <p><strong>Segundo Nombre:</strong> ${data.Seg_Nombre}</p>
                        <p><strong>Primer Apellido:</strong> ${data.Prim_Apellido}</p>
                        <p><strong>Segundo Apellido:</strong> ${data.Seg_Apellido}</p>
                        <p><strong>Género:</strong> ${data.Genero}</p>
                        <p><strong>Teléfono:</strong> ${data.Telefono}</p>
                        <p><strong>Correo:</strong> ${data.Correo}</p>
                    `;
                }
            } catch (error) {
                console.error('Error fetching profile data:', error);
            }
        }

        // Llama a la función para obtener los datos del cliente cuando la página se carga
        window.onload = fetchProfileData;
    </script>

    <script>
        let cart = [];

        function addToCart(product, price) {
            const existingProduct = cart.find(item => item.product === product);
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push({ product, price, quantity: 1 });
            }
            updateCart();
        }

        function updateCart() {
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

        function removeFromCart(product) {
            cart = cart.filter(item => item.product !== product);
            updateCart();
        }

        function clearCart() {
            cart = [];
            updateCart();
        }

        function toggleCart() {
            const cartContainer = document.getElementById('cart-container');
            cartContainer.style.display = cartContainer.style.display === 'block' ? 'none' : 'block';
        }

        function toggleProfile() {
            const profileContainer = document.getElementById('profile-container');
            profileContainer.style.display = profileContainer.style.display === 'block' ? 'none' : 'block';
        }

        function editProfile() {
            alert('Función para editar perfil no implementada.');
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
    </script>
    <script src="js/cart.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut</title>
    <link href="img/icon-p.png" rel="icon">
    <link rel="stylesheet" href="Assets/css/inter-in.css">
</head>

<body>
    <main id="hero">
    <header>
        <div class="header-container">
            <div class="logo">
                <h1 class="logo"><a href="inter-inicio.php"><img src="Assets/img/icono.png" alt="icon" style="width: 60px;"></a></h1>
            </div>
        </div>
        <div>
            <h2 class="eri">INZUFRUT</h2>
        </div>
        <i class="bi bi-list mobile-nav-toggle"></i> <!-- Icono de menú para dispositivos móviles -->
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="btn-get-started scrollto" href="inter-inicio.php">Inicio</a></li>
                <li><a class="btn-get-started scrollto" href="carrito/tienda.php">Productos</a></li>
                <li><a class="btn-get-started scrollto" href="Contactanos/contactanos.php">Contactanos</a></li>
                <li><a class="btn-get-started scrollto" href="cliente/registro_cliente.php">Registrate</a></li>
            </ul>

            <div class="profile-icon" onclick="toggleProfile()">
                <img src="Assets/img/usuario.png" alt="Profile Icon">
            </div>
        </nav>
        <button class="hamburger" onclick="toggleMenu()">☰</button>
    </header>

       <video autoplay muted loop>
            <source src="Assets/videos/ini-inter.mp4" type="video/mp4">
        </video>

        <section>
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
                <h1>BIENVENIDO A INZUFRUT</h1>
                <h2>Si eres parte de esta familia inicia sesion</h2>
                <a href="inicio sesion/iniciosesion.php" class="btn-get-started scrollto">INCIAR SESION</a>
            </div>
        </section>
    </main>

    <h2 class="titulo">Nuestros productos</h2>

    <section class="produc-vista">
        <div class="product">
            <img src="Assets/img/manzana.jpg" alt="Manzana">
            <h3>Manzana</h3>
            <p>La manzana es una fruta deliciosa y nutritiva, rica en fibra y antioxidantes.</p>
            <p><strong>Precio:</strong> $5.000 k</p>
            <button class="add-to-cart" data-product="Manzana" data-price="5000">Agregar al Carrito</button>
        </div>
        <div class="product">
            <img src="Assets/img/naranja.jpg" alt="Naranja">
            <h3>Naranja</h3>
            <p>La naranja es una excelente fuente de vitamina C y es perfecta para preparar jugos frescos.</p>
            <p><strong>Precio:</strong> $4.000 k</p>
            <button class="add-to-cart" data-product="Naranja" data-price="4000">Agregar al Carrito</button>
        </div>
        <div class="product">
            <img src="Assets/img/uva.jpg" alt="Uva">
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
        <button onclick="checkout()">Realizar Compra</button>
    </div>

    <div class="profile-container" id="profile-container">
        <h2>Perfil del Cliente</h2>
        <div id="profile-data">
            <!-- Datos del cliente se insertarán aquí -->
        </div>
        <button onclick="editProfile()">Editar Perfil</button>
        <button onclick="deleteProfile()">Eliminar Perfil</button>
    </div>

    <div id="edit-profile-container" style="display:none;">
        <h2>Editar Perfil</h2>
        <form id="edit-profile-form">
            <label for="Prim_Nombre">Primer Nombre:</label>
            <input type="text" id="Prim_Nombre" name="Prim_Nombre"><br>
            <label for="Seg_Nombre">Segundo Nombre:</label>
            <input type="text" id="Seg_Nombre" name="Seg_Nombre"><br>
            <label for="Prim_Apellido">Primer Apellido:</label>
            <input type="text" id="Prim_Apellido" name="Prim_Apellido"><br>
            <label for="Seg_Apellido">Segundo Apellido:</label>
            <input type="text" id="Seg_Apellido" name="Seg_Apellido"><br>
            <label for="Telefono">Teléfono:</label>
            <input type="text" id="Telefono" name="Telefono"><br>
            <label for="Correo">Correo:</label>
            <input type="email" id="Correo" name="Correo"><br>
            <button type="button" onclick="saveProfile()">Guardar</button>
        </form>
    </div>

    <footer>
        <p>Dirección: Calle Ficticia #123, Ciudad Imaginaria</p>
        <a href="mailto:inzufruts.a.s@outlook.es" style="color: white;">inzufruts.a.s@outlook.es</a>
        <p>Tel: +57 320 778-5187</p>
        <div class="social-icons">
            <a href="" target="_blank"><img src="Assets/img/facebook.png" alt="Facebook"></a>
            <a href="" target="_blank"><img src="Assets/img/instagram.png" alt="Instagram"></a>
            <a href="" target="_blank"><img src="Assets/img/twitter.png" alt="Twitter"></a>
        </div>
        <div class="logo-ft">
            <h1 class="logo"><a href="inter-inicio.php"><img src="Assets/img/icono.png" alt="icon" style="width: 60px;"></a></h1>
        </div>
        <p>Todos los derechos reservados &copy; 2024 Inzufrut</p>
    </footer>

    <script>
        function toggleMenu() {
            var navbar = document.getElementById('navbar');
            var ul = navbar.getElementsByTagName('ul')[0];
            if (ul.style.display !== 'block') {
                ul.style.display = 'block';
            } else {
                ul.style.display = 'none';
            }
        }

        function checkWindowSize() {
            var navbar = document.getElementById('navbar');
            var ul = navbar.getElementsByTagName('ul')[0];
            if (window.innerWidth <= 600) {
                ul.style.display = 'none';
            } else {
                ul.style.display = '';
            }
        }

        window.addEventListener('resize', checkWindowSize);

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

        function toggleProfile() {
            const profileContainer = document.getElementById('profile-container');
            profileContainer.style.display = profileContainer.style.display === 'block' ? 'none' : 'block';
        }

        function editProfile() {
            const editProfileContainer = document.getElementById('edit-profile-container');
            editProfileContainer.style.display = editProfileContainer.style.display === 'block' ? 'none' : 'block';
        }

        async function saveProfile() {
            const form = document.getElementById('edit-profile-form');
            const formData = new FormData(form);

            try {
                const response = await fetch('update_cliente.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                if (result.success) {
                    alert('Perfil actualizado exitosamente');
                    fetchProfileData();
                    editProfile();
                } else {
                    alert('Error al actualizar el perfil: ' + result.message);
                }
            } catch (error) {
                console.error('Error updating profile:', error);
            }
        }

        async function deleteProfile() {
            if (confirm('¿Estás seguro de que deseas eliminar tu perfil?')) {
                try {
                    const response = await fetch('delete_cliente.php', {
                        method: 'POST'
                    });
                    const result = await response.json();
                    if (result.success) {
                        alert('Perfil eliminado exitosamente');
                        window.location.href = 'inter-inicio.php';
                    } else {
                        alert('Error al eliminar el perfil: ' + result.message);
                    }
                } catch (error) {
                    console.error('Error deleting profile:', error);
                }
            }
        }

        window.onload = fetchProfileData;

        let cart = [];

        function addToCart(product, price) {
            const existingProduct = cart.find(item => item.product === product);
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push({
                    product,
                    price,
                    quantity: 1
                });
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

        function checkout() {
            alert('Función de compra no implementada.');
        }

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const product = button.getAttribute('data-product');
                const price = button.getAttribute('data-price');
                addToCart(product, price);
            });
        });
    </script>
</body>

</html>
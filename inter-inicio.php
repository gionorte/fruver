<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut</title>
    <link href="img/icon-p.png" rel="icon">
    <link rel="stylesheet" href="css/inter-in.css">
</head>
<body>
    <main id="hero">
    <header>
        <div class="logo">
            <h1 class="logo"><a href="inter-inicio.php"><img src=img/icono.png alt="icon" style="width: 60px;"></a></h1>      
        </div>
        <h2 class="eri">INZUFRUT</h2>
        <div class="contact-info d-flex align-items-center">
            
            <i class="bi bi-envelope-fill"></i><a href="mailto:contact@example.com">inzufruts.a.s@outlook.es</a>
            <i class="bi bi-phone-fill phone-icon"></i> <a href=""> +57 320 778 5187 </a>
        </div>
        <i class="bi bi-list mobile-nav-toggle"></i> <!-- Icono de menú para dispositivos móviles -->
        <nav id="navbar" class="navbar">
            <ul >
                <li><a class="btn-get-started scrollto" href="inter-inicio.php" >Inicio</a></li>
                <li><a class="btn-get-started scrollto" href="#">Productos</a></li>
                <li><a class="btn-get-started scrollto" href="contactanos.php">contactanos</a></li>
                <li><a class="btn-get-started scrollto" href="registrar.php">Registrate</a></li>
            </ul>
        </nav>
    </header>

    <video autoplay muted loop>
            <source src="videos/ini-inter.mp4" type="video/mp4">
        </video>
        <div class="capa"></div>

    <section>
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
            <h1>BIENVENIDO A INZUFRUT</h1>
            <h2>Si eres parte de ésta familia inicia sesion</h2>
            <a href="iniciosesion.php" class="btn-get-started scrollto">INCIAR SESION</a>
          </div>
    </section>
    </main>
    <section class="produc-vista">
        <h2>Nuestros productos</h2>
        <div class="product">
            <img src="img/manzana.jpg" alt="Manzana">
            <h3>Manzana</h3>
            <p>La manzana es una fruta deliciosa y nutritiva, rica en fibra y antioxidantes.</p>
            <p><strong>Precio:</strong> $5.000 k</p>
        </div>
        <div class="product">
            <img src="img/naranja.jpg" alt="Naranja">
            <h3>Naranja</h3>
            <p>La naranja es una excelente fuente de vitamina C y es perfecta para preparar jugos frescos.</p>
            <p><strong>Precio:</strong> $4.000 k</p>
        </div>
        <div class="product">
            <img src="img/uva.jpg" alt="Uva">
            <h3>Uva</h3>
            <p>Las uvas son pequeñas bombas de energía, ideales para un refrigerio saludable o para acompañar postres.</p>
            <p><strong>Precio:</strong> $6.000 k</p>
        </div>
    </section>
    

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
            <h1 class="logo"><a href="inter-inicio.php"><img src=img/icono.png alt="icon" style="width: 60px;"></a></h1>      
        </div>

</footer>


    <script>
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
</body>
</html>

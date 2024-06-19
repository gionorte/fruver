<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inzufrut - Recuperar contraseña</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        #hero {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            color: rgb(7, 7, 7);
            text-align: center;
            font-size: 20px;
        }

        header {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 20px;
            z-index: 10; /* Asegura que el logo esté siempre en el frente */
        }

        header .logo {
            display: inline-block;
        }

        .inicio {
            text-align: center;
            border-radius: 10px;
            border: 5px solid rgb(250, 150, 1);
            background-color: rgba(245, 241, 220, 0.623); /* Fondo semitransparente */
            padding: 30px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra para mayor visibilidad */
            z-index: 1;
        }
        

h1 {
    display: block;
    font-size: 20px;
    margin-block-start: 0.67em;
    margin-block-end: 0.67em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    unicode-bidi: isolate;
}

        h2 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input {
            font-size: 20px;
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 3px solid rgba(250, 150, 1, 0.7); /* Bordes semitransparentes */
            background-color: transparent;
            color: rgb(10, 10, 10); /* Texto negro */
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.7); /* Color del placeholder semitransparente */
        }

        button {
            padding: 10px 20px;
            background-color: rgb(250, 150, 1);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: rgb(220, 130, 0);
        }

        a {
            margin-top: 10px;
            color: rgb(250, 150, 1);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        video {
            position: absolute;
            top: 10px;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .capa {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
    </style>
</head>

<body class="text-center">
    <div id="hero">
    <header>
            <div class="logo">
                <h1 class="logo"><a href="../inicio sesion/iniciosesion.php"><img src="../Assets/img/icono.png" alt="icono" style="width: 60px;"></a></h1>
            </div>
        </header>
        <div class="inicio">
            <main class="form-signin w-100 m-auto">
                <form action="recuper_contr.php" method="post">
                    <h1>Recuperar Contraseña</h1>
                    <h2 class="h3 mb-3 fw-normal">Introduce tu correo electrónico</h2>
                    <div class="form-floating my-3">
                    <label for="floatingInput">Correo electrónico</label><br>
                    <br>
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Recuperar contraseña</button>
                </form>
            </main>
        </div>
        <video autoplay muted loop>
            <source src="../Assets/videos/ini-inter.mp4" type="video/mp4">
        </video>
        <div class="capa"></div>
    </div>
</body>

</html>

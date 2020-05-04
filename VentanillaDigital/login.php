<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT * FROM login WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $hash = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if ($hash !=null && password_verify($_POST['password'], $hash['password'])) {
        $_SESSION['user_id'] = $hash['id'];
        header("Location: index.php");
    } else {
        $message = 'Usuario o contraseña no válido';
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Servcios Escolares ITMerida</title> 
        <link  rel = "icon"  href = "PaginaTec/img/LogoTec.ico"  type = "image / x-icon" >
        <script src="https://kit.fontawesome.com/c0d428ad28.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="estilosLogin.css">
    </head>
    <body class="hidden">
        <div class="centrado" id="onload" >
            <div class="lds-hourglass"></div>
        </div>
        <header>
            <nav id="nav" class="nav1">
                <div class="contenedor-nav">
                    <div class="textos-nav">
                        <h1>Instituto Tecnológico de Mérida</h1>
                        <h2>Servicios Escolares</h2>
                    </div>
                    <div class="logo" id="logo-top">
                        <img src="PaginaTec/img/LogoTec.png" alt="">
                    </div>
                </div>
            </nav>
            <div class="cabecera">
                <img src="PaginaTec/img/cabecera1.gif" alt="">
            </div>
        </header>
        <main>
            <section class="login1 contenedor" id="login">
                <div class="login-box login-1" id="Login">
                    <img class="avatar" src="PaginaTec/img/LogoTec.png" alt="">
                    <h1>Iniciar Sesión</h1>                    
                    <?php 
                        if(!empty($message)): ?>
                        <font color="#ffbf00" size="4"> <?= $message ?></font>
                    <?php endif; ?>
                    <form method="POST" action="login.php">
                        <!--Username-->
                        <label for="email">Correo institucional</label>
                        <input type="text" name="email" placeholder="Ingresa tu correo institucional">

                        <!--Password-->
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" placeholder="Ingresa tu contraseña">

                        <input type="submit" value="Ingresar">
                        <div class="enlaces" id="enlaces">
                            <a href="#" id="enlace-recuperarcontraseña" class="btn-header">Olvidé mi contraseña</a><br>
                            <a href="signup.php"id="enlace-registrarse" class="btn-header">Regístrate</a>
                        </div>
                    </form>
                </div>
        </main>
        <footer class= "footer" id="contacto">
            <div class="footer contenedor">
                <div class="footer-logo">
                    <img src="PaginaTec/img/LogoTec.png" alt="">
                </div>
                <div class="TextoFooter">
                    <p><span>Instituto Tecnológico de Mérida</span></p>
                    <p>Av. Tecnológico km. 4.5 S/N C.P. 97118</p>
                    <p>Quejas y Sugerencias: <a href="mailto:quejasysugerencias@itmerida.mx">quejasysugerencias@itmerida.mx</a></p>
                    <p>Tel:<a href="Tel:(999)&nbsp;964-5000">(999)&nbsp;964-5000TEST</a></p>
                </div>
                <div class="iconos">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-youtube"></i>
                </div>
                <p class="derechos">© 2020 Derechos Reservados</p>
            </div>
        </footer>
        <script src="jquery.js"></script>
        <script src="main.js"></script>
    </body>
</html>
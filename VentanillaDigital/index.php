  <?php

  session_start();

  require 'database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, nombre, email, password FROM login WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
}else{
    header("Location: login.php");
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
        <link rel="stylesheet" href="PaginaTec/estilosIndex.css">
    </head>
    <body class="hidden">
        <div class="centrado1" id="onload" >
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
                    <div class="enlaces" id="enlaces">
                        <a href="#" id="enlace-inicio" class="btn-header">Inicio</a>
                        <a href="#" id="enlace-anuncio" class="btn-header">Avisos</a>
                        <a href="#" id="enlace-tramites" class="btn-header">Trámites</a>
                        <a href="#" id="enlace-contacto" class="btn-header">Contacto</a>
                    </div>
                    <div class="icono" id="open">
                        <span> &#9776; </span>
                    </div>
                </div>
            </nav>
            <div class="cabecera">
                <img src="PaginaTec/img/cabecera1.gif" alt="">
            </div>
        </header>
        <main class="main">
            <div class="logout">
                <?php if(!empty($user)): ?>
                <br><p> Bienvenido: <?= $user['nombre']; ?></p>
                <?php endif; ?>
                <a href="logout.php" class="logout-button">Cerrar Sesión</a>
            </div>
            <section class="contenedor" id="anuncios">
                <h3>Avisos</h3>
                <div class="anuncios">
                    <div class="slider">
                        <input type="radio" id="1" name="image-slide" hidden/>
                        <input type="radio" id="2" name="image-slide" hidden/>
                        <input type="radio" id="3" name="image-slide" hidden/>
                        <div class="slide">
                            <div class="item-slide">
                                <img src="PaginaTec/img/compu1.jpg" alt="" class="av" id="av1">
                            </div>
                            <div class="item-slide">
                                <img src="PaginaTec/img/seguimiento1.jpg" alt="" class="av" id="av2">
                            </div>
                            <div class="item-slide">
                                <img src="PaginaTec/img/constancia1.jpg" alt="" class="av" id="av3">
                            </div>
                        </div>
                        <div class="pagination">
                            <label class="pagination-item" for="1">
                                <img src="PaginaTec/img/compu1.jpg" alt="">
                            </label>
                            <label class="pagination-item" for="2">
                                <img src="PaginaTec/img/seguimiento1.jpg" alt="">
                            </label>
                            <label class="pagination-item" for="3">
                                <img src="PaginaTec/img/constancia1.jpg" alt="">
                            </label>
                        </div>
                    </div>
                </div>
            </section>
            <section class="tramites contenedor" id="tramites">
                 <h3>Trámites</h3>
                <p>Selecciona un trámite</p>
                <div class="card">
                    <div class="content-card" id="constancia">
                        <div class="trm">
                            <img src="PaginaTec/img/constancia1.jpg" alt="">
                        </div>
                        <div class="texto-trm">
                            <h4>Constancia de estudios</h4>
                        </div>
                    </div>
                    <div class="content-card" id="horario">
                        <div class="trm">
                            <img src="PaginaTec/img/horario1.jpg" alt="">
                        </div>
                        <div class="texto-trm">
                            <h4>Horario</h4>
                        </div>
                    </div>
                    <div class="content-card" id="seguimiento">
                        <div class="trm">
                            <img src="PaginaTec/img/seguimiento1.jpg" alt="">
                        </div>
                        <div class="texto-trm">
                            <h4>Seguimiento académico</h4>
                        </div>
                    </div>
                </div>
            </section>
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
        <script src="PaginaTec/jquery.js"></script>
        <script src="PaginaTec/mainIndex.js"></script>
    </body>
</html>
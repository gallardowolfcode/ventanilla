<?php

    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        header('Location: index.php');
    }

    $message = '';
    if (!empty($_POST['nombre']) && !empty($_POST['carrera']) && !empty($_POST['matricula']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
        if(filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL)){
            if($_POST['password'] == $_POST['confirm_password']){
                $sql = "INSERT INTO login (nombre, carrera, matricula, email, password) VALUES (:nombre, :carrera, :matricula, :email, :password)";
                $state = $conn->prepare($sql);
                $state->bindParam(':nombre', $_POST['nombre']);
                $state->bindParam(':carrera',$_POST['carrera']);
                $state->bindParam(':matricula',$_POST['matricula']);
                $state->bindParam(':email',$_POST['email']);
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $state->bindParam(':password', $password);

                if($state->execute()){
                    $message = 'Usuario creado correctamente';
                } else{
                    $message = 'Ha ocurrido un error en tu registro';
                }
            }else{
                $message = 'Las contraseñas no coinciden';
            }
        }else{
            $message = 'Ingrese un correo electrónico válido';
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
        <link rel="stylesheet" href="estilosSignUp.css">
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
                <div class="login-box register-1" id="Register">
                    <img class="avatar" src="PaginaTec/img/LogoTec.png" alt="">
                    <h1>Regístrate</h1>
                    <?php 
                        if(!empty($message)): ?>
                        <font color="#ffbf00" size="4"> <?= $message ?></font>
                    <?php endif; ?>
                    <form method="post" action="signup.php">
                        <!--Nombre-->
                        <label for="nombre">Nombre completo</label>
                        <input type="text" name="nombre" placeholder="Ingresa tu nombre completo">
                        <!--Carrera-->
                        <!--
                        <input type="text" name="carrera" placeholder="Ingresa las siglas de tu carrera">
                        -->
                        <div class="carrera">
                            <label for="carrera">Carrera</label>
                            <select name="carrera" class="select-box">
                                <option value=""disabled selected class="first">Seleccione su carrera</option>
                                <option value="IGE">Ingeniería en Gestión Empresarial</option>
                                <option value="IA">Ingeniería Ambiental</option>
                                <option value="IBQ">Ingeniería Bioquímica</option>
                                <option value="IBM">Ingeniería Biomédica</option>
                                <option value="IQ">Ingeniería Química</option>
                                <option value="IELE">Ingeniería Eléctrica</option>
                                <option value="IELC">Ingeniería Electrónica</option>
                                <option value="IM">Ingeniería Mecánica</option>
                                <option value="IC">Ingeniería Civil</option>
                                <option value="II">Ingeniería Industrial</option>
                                <option value="ISC">Ingeniería en Sistemas Computacionales</option>
                                <option value="LA">Licenciatura en Administración</option>
                            </select>
                        </div>
                        <!--Matrícula-->
                        <label for="matricula">Matrícula</label>
                        <input type="text" name="matricula" placeholder="Ingresa tu matricula">
                        <!--Email-->
                        <label for="email">Correo institucional</label>
                        <input type="text" name="email" placeholder="Ingresa tu correo institucional">

                        <!--Password-->
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" placeholder="Ingresa tu contraseña">
                        <!--Confirm-Password-->
                        <label for="confirm_password">Confirma tu contraseña</label>
                        <input type="password" name="confirm_password" placeholder="Confirma tu contraseña">

                        <input type="submit" value="Regístrate">

                        <a href="login.php" id="iniciar-sesion">Iniciar sesión</a><br>
                    </form>
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
        <script src="jquery.js"></script>
        <script src="main.js"></script>
    </body>
</html>

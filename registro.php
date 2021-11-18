<?php
    require_once("./controller/DB.php");
    require_once("./controller/Mensajes.php");

    if (isset($_POST['submit'])) {
        //TODO: comprobar que el usuario no exista antes de meterlo
        $usuario = new Usuario(
            $_POST['usuario'],
            $_POST['nombre'],
            $_POST['apellido'],
            $_POST['email'],
            'usuario'
        );
        $passwd = hash('sha512',$_POST['password']);
        addUser( $usuario , $passwd );
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./styles/style.css">
        <title>Registro</title>
    </head>
    <body>
        <a href="./" class="round_button border_radius_50 position_absolute w50px h50px">
            <svg class="svg_dark_purple" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                width="50px" height="50px" viewBox="0 0 979.469 979.469" style="enable-background:new 0 0 979.469 979.469;"
                xml:space="preserve">
            <g>
                <path d="M421.337,945.03l-377.5-378.1c-44.4-44.5-44.4-111.1,0-155.401l377.5-377.3c44.3-44.3,113.7-46.2,157.7-2.2
                    c43,43,38.399,115.5-3.4,157.2l-184.399,184.4c0,0,465.1,0.6,465.3,0.6c30.8,0,60.5,12,81.6,34.4
                    c50.601,54,37.101,148.5-27.7,184.4c-16.399,9.101-35.1,13.9-53.899,13.801l-465.3-0.4c0,0,184.3,184.2,184.399,184.3
                    c41.9,41.9,46.101,114.101,3.4,156.9C535.037,991.631,465.637,989.331,421.337,945.03z"/>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            </svg>
        </a>
        <form action="" method="post" class="flex flex_h_center flex_v_center w100 h100">
            <div  class="box flexbox flex_col">
                <p class="input_label">Usuario</p>
                <!-- INPUT - USUARIO -->
                    <input type="text" name="usuario"
                        class="input_text fsize30 w500px"
                        spellcheck="false"
                        placeholder="introduce un usuario"
                        pattern=".{2,128}"
                        autocomplete="off"
                        value="<?php if (isset($_POST['submit'])) { echo $_POST['usuario']; }?>"
                        required
                    >
                <!-- / INPUT - USUARIO -->
                <p class="input_label">Nombre</p>
                <!-- INPUT - NOMBRE -->
                    <input type="text" name="nombre"
                        class="input_text fsize30 w500px"
                        spellcheck="false"
                        placeholder="introduce tu nombre"
                        pattern=".{2,128}"
                        autocomplete="off"
                        value="<?php if (isset($_POST['submit'])) { echo $_POST['nombre']; }?>"
                        required
                    >
                <!-- / INPUT - NOMBRE -->
                <p class="input_label">Primer apellido</p>
                <!-- INPUT - APELLIDO -->
                    <input type="text" name="apellido"
                        class="input_text fsize30 w500px"
                        spellcheck="false"
                        placeholder="introduce tu primer apellido"
                        pattern=".{2,128}"
                        autocomplete="off"
                        value="<?php if (isset($_POST['submit'])) { echo $_POST['apellido']; }?>"
                        required
                    >
                <!-- / INPUT - APELLIDO -->
                <p class="input_label">E-Mail</p>
                <!-- INPUT - EMAIL -->
                    <input type="text" name="email"
                        class="input_text fsize30 w500px"
                        spellcheck="false"
                        placeholder="introduce un E-Mail"
                        pattern=".{2,100}+@[a-z0-9.-]{1,15}+\.[a-z]{2,4}$"
                        autocomplete="off"
                        value="<?php if (isset($_POST['submit'])) { echo $_POST['email']; }?>"
                        required
                    >
                <!-- / INPUT - EMAIL -->
                <p class="input_label">Contraseña</p>
                <!-- INPUT - PASSWORD -->
                    <input type="password" name="password"
                        class="input_text fsize30 w500px"
                        spellcheck="false"
                        placeholder="introduce una contraseña"
                        pattern=".{2,128}"
                        autocomplete="off"
                        required
                    >
                <!-- / INPUT - PASSWORD -->
                <br>
                <div class="w100 flex flex_end">
                    <!-- INPUT - SUBMIT -->
                    <input type="submit" value="REGÍSTRAME" name="submit" class="input_submit">
                    <!-- / INPUT - SUBMIT -->
                </div>
            </div>
        </form>
    </body>
</html>
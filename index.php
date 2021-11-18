<?php
    /** Inicio la sesión */
    session_start();

    /** Importo todo */
    foreach (glob("./controller/*.php") as $filename){
        require_once $filename;
    }

    /** Autologin */
    if( isset($_COOKIE['login']) && isset($_COOKIE['id_sesion']) ){
        if(compruebaRecordar( $_COOKIE['login'], $_COOKIE['id_sesion'] )){
            $_SESSION['user'] = serialize(getUserDB($_COOKIE['login']));
            header("Location: catalog");
        }
    }

    /**
     * Recogemos los datos del formulario
     */
    if (isset($_POST['submit'])) {

        // Login del usuairo
        $user = $_POST['user'];

        // Contraseña del usuario
        $pswd = hash("sha512",$_POST['passwd']);
        
        if(checkLogIn($user,$pswd)){
            /**
             * Obtengo los datos del usuario en forma de objeto,
             * lo serialzo y meto la cadena resultante en la sesión 'user'
             */
            $_SESSION['user'] = serialize(getUserDB($user));

            $_SESSION['login'] = $_POST['user'];

            if(isset($_POST['rememberPswd']) && ($_POST['rememberPswd']=="on")){
                
                //regenero la ID session
                session_regenerate_id(); 
    
                //actualizar la base de datos con session_id
                updateSessionID($_POST['user'],session_id());
    
                //crear la cookie con login y session_id
                $expira = 3600 * 24;// 24 horas (3600 (1h) * 24)
                setcookie("login",$_POST['user'],time()+$expira);
                setcookie("id_sesion",session_id(),time()+$expira);
            }

            // Cámbio de página
            header('Location: catalog');

        }else{

            /**
             * En caso de que el usuario o la contraseña no sean correctos,
             * muestro un mensaje de error
             */
            mensajeError("Usuario o contraseña incorrectos");

        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        <link rel="stylesheet" href="./styles/style.css">
    </head>
    <body>
        <form action="" method="post" class="flex flex_col flex_h_center flex_v_center h100 w100">
            <h1 class="w100 fsize30 purple w100 flex flex_h_center">
                Log In
            </h1>
            <div  class="box flexbox flex_col">
                <label for="userInput">
                    <p class="input_label">Usuario</p>
                    <!-- INPUT USUARIO (LOGIN) -->
                        <input type="text"
                            name="user"
                            class="input_text fsize30"
                            spellcheck="false"
                            placeholder="introduce tu usuario"
                            pattern=".{2,128}"
                            autocomplete="off"
                            value="<?php if (isset($_POST['submit'])) { echo $_POST['user']; } ?>"
                            required
                        >
                    <!-- / INPUT USUARIO (LOGIN) -->
                </label>
                <label for="passwdInput">
                    <p class="input_label">Contraseña</p>
                    <!-- INPUT CONTRASEÑA -->
                        <input type="password"
                            name="passwd"
                            class="input_text fsize20"
                            spellcheck="false"
                            placeholder="introduce tu contraseña"
                            pattern=".{2,128}"
                            autocomplete="off"
                            required
                        >
                    <!-- / INPUT CONTRASEÑA -->
                </label>
                <div class="w100 pad_left10 pad_bottom30">
                    <label for="rememberPswd">
                        <!-- INPUT RECORDAR CONTRASEÑA -->
                            <input type="checkbox" name="rememberPswd" checked>
                        <!-- INPUT RECORDAR CONTRASEÑA -->
                        <span class="fsize20 purple">recordar contraseña</span>
                    </label>
                </div>
                <div class="w100 flex flex_end">
                    <div class="flexbox marg_top10px">
                        <a href="registro" class="fsize20 purple enlace">regístrate</a>
                    </div>
                    <label for="entrarBtn">
                        <!-- INPUT SUBMIT -->
                            <input type="submit" name="submit" value="ENTRAR" class="input_submit">
                        <!-- / INPUT SUBMIT -->
                    </label>
                </div>
            </div>
        </form>
    </body>
</html>
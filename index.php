<?php
    /** Inicio la sesión */
    session_start();

    /** Importo todo */
    foreach (glob("./controller/*.php") as $filename){
        require_once $filename;
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
                            pattern="[a-zA-Z_0-9]{2,64}"
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
                            pattern="[a-zA-Z_0-9]{2,64}"
                            autocomplete="off"
                            required
                        >
                    <!-- / INPUT CONTRASEÑA -->
                </label>
                <div class="w100 pad_left10 pad_bottom30">
                    <label for="rememberPswd">
                        <!-- INPUT RECORDAR CONTRASEÑA -->
                            <input type="checkbox" name="rememberPswd" value="true" checked>
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
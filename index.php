<?php
    /** Inicio la sesión */
    session_start();

    /** Importo todo */
    foreach (glob("./controller/*.php") as $filename){
        require_once $filename;
    }

    if (isset($_POST['submit'])) {

        $user = $_POST['user'];
        $pswd = hash("sha512",$_POST['passwd'],false);
        
        if(DB::checkLogIn($user,$pswd)){
            $_SESSION['user'] = serialize(DB::getUserDB($user));
            header('Location: catalog');
        }else{
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
                    <input type="text"
                        name="user"
                        class="input_text fsize30"
                        spellcheck="false"
                        placeholder="introduce tu usuario"
                        pattern="[a-zA-Z_0-9]{2,64}"
                        autocomplete="off"
                        value="<?php if (isset($_POST['submit'])) { echo $_POST['user']; }?>"
                        required
                    >
                </label>
                <label for="passwdInput">
                    <p class="input_label">Contraseña</p>
                    <input type="password"
                        name="passwd"
                        class="input_text fsize20"
                        spellcheck="false"
                        placeholder="introduce tu contraseña"
                        pattern="[a-zA-Z_0-9]{2,64}"
                        autocomplete="off"
                        required
                    >
                </label>
                <div class="w100 pad_left10 pad_bottom30">
                    <label for="rememberPswd">
                        <input type="checkbox" name="rememberPswd" value="true" checked>
                        <span class="fsize20 purple">recordar contraseña</span>
                    </label>
                </div>
                <div class="w100 flex flex_end">
                    <div class="flexbox marg_top10px">
                        <a href="registro" class="fsize20 purple enlace">regístrate</a>
                    </div>
                    <label for="entrarBtn"></label><input type="submit" name="submit" value="ENTRAR" class="input_submit">
                </div>
            </div>
        </form>
    </body>
</html>
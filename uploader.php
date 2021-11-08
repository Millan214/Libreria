<?php

    /** Inicio la sesión */
    session_start();

    foreach (glob("./controller/*.php") as $filename){
        require_once $filename;
    }

    require_once "./controller/addons/PaginaError.php";

    /** Compruebo que esté registrado */
    if (isset($_SESSION['user'])) {
        /** Si está registrado */
        $registrado = true;

        /** Obtengo el usuario */
        $user = unserialize($_SESSION['user']);

    }else{
        $registrado = false;
    }


    if ($registrado) {
        
        if( checkInputs()){

            /** Creo el OBJETO libro */
            $libro = new Libro(
                "./img/".$_FILES['image_input']['name'],
                0,
                $_POST['titulo'],
                $_POST['autor'],
                $_POST['editorial'],
                date('Y/n/j')
            );

            addLibro($libro);

            /** Añado la imagen */
            $target_path = "./img/";
            $target_path = $target_path.basename($_FILES['image_input']['name']);
            if(move_uploaded_file($_FILES['image_input']['tmp_name'],$target_path)){
                $_SESSION['success_imagen'] = true;
                header("Location: nuevoLibro");
            }else{
                $_SESSION['success_imagen'] = false;
                header("Location: nuevoLibro");
            }

        }

    }else{
        ?>
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <link rel="stylesheet" href="styles/style.css">
                </head>
                <body>
                    <?php
                        new PaginaError();
                    ?>
                </body>
            </html>
        <?php
        
    }

    function checkInputs(){
        if (
            isset($_POST['titulo']) && !empty($_POST['titulo']) &&
            isset($_POST['autor']) && !empty($_POST['autor']) &&
            isset($_POST['editorial']) && !empty($_POST['editorial']) &&
            isset($_FILES['image_input']['name']) && !empty($_FILES['image_input']['name']) &&
            $_FILES['image_input']['error'] == 0
            ) {
            return true;
        }
        return false;
    }

?>

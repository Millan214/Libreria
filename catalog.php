<?php
    /** Inicio la sesión */
    session_start();

    /** Esta variable booleana determina si mostramos la página normal o el mensaje de regístrate primero */
    $registrado = false;

    foreach (glob("./controller/addons/*.php") as $filename){
        include $filename;
    }
    foreach (glob("./controller/*.php") as $filename){
        require_once $filename;
    }

    /** 
     * TODO: 
     * Conexión con base de datos
     */

    if (isset($_SESSION['user'])) {
        $registrado = true;
        $user = unserialize($_SESSION['user']);
        $isAdmin = $user->isAdmin();
        if ( isset($_POST['buscar_submit']) && $_POST['input_busqueda'] != "" ) {
            $searchBy = $_POST['seach_by_radios'];
            $inputBusqueda = $_POST['input_busqueda'];
        }else{

        }
    }else{
        $registrado = false;
    }
    
?>
        <!-- PÁGINA NORMAL -->
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <title>Catalogo</title>
                <link rel="stylesheet" href="./styles/style.css">
            </head>
            <body>
                <?php
                    if($registrado){
                ?>
                    <!-- PÁGINA NORMAL -->
                    <form action="" method="post">
                        <div class="flex h99 w100">
                            <!-- Left bar -->
                            <?php new LeftBar($isAdmin);?>
                            <!-- / Left bar -->
                            <div class="flex w100 margin_right_10px flex_col">

                                <!-- Top bar -->
                                <?php new TopBar($isAdmin);?>
                                <!-- / Top bar -->

                                <!-- Main content -->
                                    <iframe name="mainframe" src="tabla.php?
                                    <?php
                                        if (isset($inputBusqueda)) {
                                            echo "query=".$searchBy."/".$inputBusqueda;
                                        }
                                    ?>" frameborder="0" 
                                        class="
                                            w100
                                            h100
                                            marg10px
                                            nobg
                                            ">
                                    </iframe>
                                    <!-- if adimn (espacio para que se vean bien los botones) -->
                                        <?php if ($isAdmin) { ?>
                                            <div class="w100 h15"></div>
                                        <?php } ?>
                                    <!-- / if admin -->
                                <!-- / Main content -->
                            </div>

                            <!-- Admin buttons -->
                                <?php if ($isAdmin) { ?>
                                    <div
                                        class="
                                            marg10px
                                            marg
                                            flex
                                            position_absolute
                                            pos_abs_right0
                                            pos_abs_bot0">

                                            <a href="./nuevoLibro"
                                                class="
                                                sombra_enlace
                                                box_no_padding
                                                fsize30
                                                white
                                                marg20px
                                                pad_top10
                                                pad_bottom10
                                                pad_left30
                                                pad_right30
                                                bgpurple
                                                nodecoration
                                                "
                                            >Nuevo</a>
                        
                                    </div>
                                <?php } ?>
                            <!-- / Admin buttons -->
                        </div>
                    </form>
                <?php
                    } else {
                ?>
                    <!-- PÁGINA ERROR -->
                    <div class="w100 h100 flex flex_v_center flex_h_center flex_col">
                        <img src="./img/confused-wth.gif" alt="">
                        <h1 class="fsize30 purple text_align_center">
                            HEY! <br>
                            Primero te tienes que registrar
                        </h1>
                    </div>
                <?php
                    }
                ?>
            </body>
        </html>
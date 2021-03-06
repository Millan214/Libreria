<?php
    /** Inicio la sesión */
    //TODO: poner el boton salir como enlace a un archivo logout.php, ahí se hacen cosas.
    session_start();

    foreach (glob("./controller/addons/*.php") as $filename){
        include $filename;
    }
    foreach (glob("./controller/*.php") as $filename){
        require_once $filename;
    }

    if ( isset($_SESSION['user'])) {

        //Guardo datos relevantes sobre la página para pasarselos a la funcion que crea la página dinamicamente
        $data = [];

        $user = unserialize($_SESSION['user']);

        $data += ["user" => $user];

        if ( isset($_POST['buscar_submit']) && $_POST['input_busqueda'] != "" ) {
            $bookSearchBy = $_POST['seach_by_radios'];
            $data += ["bookSearchBy" => $bookSearchBy];

            $inputBusqueda = $_POST['input_busqueda'];
            $data += ["inputBusqueda" => $inputBusqueda];
        }
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Catalogo</title>
        <link rel="stylesheet" href="./styles/style.css">
    </head>
    <body>
        <?php
            if( isset($_SESSION['user']) ){
                mostrarPagNormal($data);
            } else {
                new PaginaError();
            }
        ?>
    </body>
</html>

<?php
    function mostrarPagNormal($data){
        ?>
            <!-- PÁGINA NORMAL -->
            <form action="catalog" method="post">
                <div class="flex h99 w100">
                    <!-- Left bar -->
                    <?php new LeftBar($data['user']->isAdmin())?>
                    <!-- / Left bar -->
                    <div class="flex w100 margin_right_10px flex_col">
                        
                        <!-- Top bar -->
                        <?php new TopBar($data['user'])?>
                        <!-- / Top bar -->

                        <!-- Main content -->
                            <iframe name="mainframe" src="tabla.php?
                            <?php
                                if (isset($data['inputBusqueda'])) {
                                    echo "query=".$data['bookSearchBy']."/".$data['inputBusqueda'];
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
                                <?php if ($data['user']->isAdmin()) { ?>
                                    <div class="w100 h15"></div>
                                <?php } ?>
                            <!-- / if admin -->
                        <!-- / Main content -->
                    </div>

                    <!-- Admin buttons -->
                        <?php if ($data['user']->isAdmin()) { ?>
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
    }
?>
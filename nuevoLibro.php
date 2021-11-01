<?php
    /** Inicio la sesión */
    session_start();

    foreach (glob("./controller/*.php") as $filename){
        require_once $filename;
    }
    foreach (glob("./controller/addons/*.php") as $filename){
        require_once $filename;
    }

    /** Compruebo que esté registrado */
    if (isset($_SESSION['user'])) {
        
        if (isset($_SESSION['success_imagen'])) {
            if ($_SESSION['success_imagen']) {
                mensajeExito("Libro añadido correctamente");
            }else{
                mensajeError("El libro no se ha podido añadir");
            }
            $_SESSION['success_imagen'] = null;
        }

        /** Obtengo el usuario */
        $user = unserialize($_SESSION['user']);

    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Añadir Libro</title>
        <link rel="stylesheet" href="./styles/style.css">
    </head>
    <body>
        <?php
            if(isset($_SESSION['user'])){
                mostrarPagNormal();
            } else {
                new PaginaError();
            }
        ?>
    </body>
</html>

<?php
    function mostrarPagNormal(){
        ?>
            <!-- PÁGINA NORMAL 
                 Tremendo truco:
                    Si al for del label le pones el mismo nombre que el id de un input,
                    el label se comportará como el input
            -->

            <!-- Botón atrás -->
            <a href="./catalog" class="round_button border_radius_50 position_absolute w50px h50px zindex3">
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

            <form action="uploader" enctype="multipart/form-data" method="post" class="w100 h100 flex flex_v_center flex_h_center">
                <div class="box flex flex_v_center">
                    <label for="image_input" class="cur_pointer">
                        <svg class=
                            "
                            border_radius_10px
                            border_radius_no_bottom
                            purple
                            border_style_dashed
                            border_style_bottom_none
                            border_style_3px
                            border_style_purple
                            "
                            xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <div class="
                            w100
                            bgpurple
                            white
                            fsize30
                            text_align_center
                            border_radius_10px
                            border_radius_no_top
                            pad_top10
                            pad_bottom10
                            ">
                            Seleccionar imagen
                        </div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="8388608"> <!-- Este num es en bytes -->
                        <input required type="file" id="image_input" name="image_input" accept="image/png, image/jpeg, image/jpg" class="visivility_hidden">
                    </label>
                    <div class="flex flex_col margin_left_20px">
                        <label for="titulo">
                            <p class="input_label">Título</p>
                            <input
                                type="text"
                                name="titulo"
                                placeholder="Introduzca el título"
                                class="input_text fsize30 w500px"
                                pattern="[a-zA-Z_0-9_ ]{2,64}"
                                autocomplete="off"
                                required>
                        </label>
                        <label for="autor">
                            <p class="input_label">Autor</p>
                            <input
                                type="text"
                                name="autor"
                                placeholder="Introduzca el autor"
                                class="input_text fsize30 w500px"
                                pattern="[a-zA-Z_0-9_ ]{2,64}"
                                autocomplete="off"
                                required>
                        </label>
                        <label for="editorial">
                            <p class="input_label">Editorial</p>
                            <input
                                type="text"
                                name="editorial"
                                placeholder="Introduzca la editorial"
                                class="input_text fsize30 w500px"
                                pattern="[a-zA-Z_0-9_ ]{2,64}"
                                autocomplete="off"
                                required>
                        </label>
                        <div class="flex flex_end">
                            <input type="submit" value="Añadir" name="submit" class="input_submit">
                        </div>
                    </div>
                </div>
            </form>
        <?php
    }
?>
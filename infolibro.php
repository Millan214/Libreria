<?php 

    session_start(); 

    foreach (glob("./controller/*.php") as $filename){
        require_once $filename;
    }
    foreach (glob("./controller/addons/*.php") as $filename){
        include $filename;
    }

    if (isset($_GET['id'])) {
        $_SESSION['book_id'] = $_GET['id'];
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles/style.css">
        <style>
            body{
                background: rgba(0, 0, 0, 0);
                padding-right: 10px;
            }
        </style>
    </head>
    <body>

        <?php
            if(isset($_SESSION['user'])){
                paginaNormal();
            }else{
                new PaginaError(true);
            }
        ?>
    </body>
</html>

<?php
    function paginaNormal(){
        
        if(isset($_GET['eliminar'])){
            deleteLibro($_SESSION['book_id']);
            unset($_SESSION['book_id']);
            header("Location: tabla");
        }

        if(isset($_GET['actualizar'])){
            if(updateLibro($_SESSION['book_id'],$_GET['bookName'],$_GET['bookAuthor'])){
                unset($_SESSION['book_id']);
                header("Location: tabla");
            }
        }

        $user = unserialize($_SESSION['user']);
        $isAdmin = $user->isAdmin();
        $libro = getBookById($_SESSION['book_id']);
        $available = isBookAvailable($libro->toArr()['id']);

        if ( isset($_GET['submit']) ) {
            if (!checkLibroPrestado($user->toArr()['login'],$_SESSION['book_id'])) {
                ?>
                    <div class="
                        fsize30
                        flex
                        h100
                        flex_h_center
                        flex_v_center
                    ">
                    <?php
                        if (prestarLibro( $user->toArr()['login'] , $_SESSION['book_id'] )) {
                            echo "El préstamo se ha realizado correctamente";
                        }else{
                            echo "Parece que este libro ya le tienes";
                        }
                    ?>
                    </div>
                <?php
            }
        }

        if( isset($_GET['devolver_submit']) ){
            if (checkLibroPrestado($user->toArr()['login'], $_SESSION['book_id'])) {
                ?>
                    <div class="
                        fsize30
                        flex
                        h100
                        flex_h_center
                        flex_v_center
                    ">
                    <?php
                        if (devolverLibro( $user->toArr()['login'] , $_SESSION['book_id'] )) {
                            echo "El libro se ha devuelto correctamente";
                        }else{
                            echo "¿que?";
                        }
                    ?>
                    </div>
                <?php
            }
        }

        ?>
        <form action="" method="get">
            <div class="input_text flex flex_v_center">
                <a href="tabla?id=<?php echo $libro->toArr()['id'];?>"
                    class=
                        "
                        sombra_enlace
                        nodecoration 
                        margin_right_30px
                        box_no_padding
                        w100px
                        h100px
                        border_radius_100px
                        flex
                        flex_v_center
                        flex_h_center
                        ">
                        <svg class="svg_dark_purple nodecoration" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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
                <img src="<?php echo $libro->toArr()['imagen']?>" alt="" class="flex_v_center w500px h500px fit_scaledown margin_right_20px">
                <div>
                    <?php if ($isAdmin) { ?>

                        <input type="text" name="bookName"
                        class="input_text fsize30 w500px"
                        spellcheck="false"
                        placeholder="sin nombre"
                        pattern=".{2,64}"
                        autocomplete="off"
                        value="<?php echo $libro->toArr()['titulo'];?>"
                        >

                        <input type="text" name="bookAuthor"
                        class="input_text fsize30 w500px"
                        spellcheck="false"
                        placeholder="sin nombre"
                        pattern=".{2,64}"
                        autocomplete="off"
                        value="<?php echo $libro->toArr()['autor'];?>"
                        >
                        <br>
                        <br>

                    <?php }else{ ?>
                        <h1><?php echo $libro->toArr()['titulo'];?></h1>
                        <p><?php echo $libro->toArr()['autor'];?></p>
                    <?php } ?>

                    <?php if (!checkLibroPrestado($user->toArr()['login'],$_SESSION['book_id'])) { ?>
                        <input type="submit" value="Solicitar préstamo" name="submit" 
                        class="sombra_enlace box fsize30 purple">
                        <?php }else{ ?>
                        <input type="submit" value="Devolver libro" name="devolver_submit" 
                        class="sombra_enlace box fsize30 purple">
                    <?php }?>
                    
                </div>
                <?php if ($isAdmin) { ?>
                    <div class="flex flex_col">
                        <input type="submit" name="eliminar" value="Eliminar"
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
                            "
                        ></input>

                        <input type="submit" name="actualizar" value="Actualizar"
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
                            "
                        ></input>
                    </div>
                <?php } ?>
                </form>
            </div>
        <?php
    }
?>
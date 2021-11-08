<?php
    /** Inicio la sesión */
    session_start();
    
    foreach (glob("./controller/*.php") as $filename){
        require_once $filename;
    }
    foreach (glob("./controller/addons/*.php") as $filename){
        require_once $filename;
    }

    if (isset($_SESSION['user'])) {
        $user = unserialize($_SESSION['user']);
        $isAdmin = $user->isAdmin();

        $libros = getAllBooks();

        if (isset($_GET['query'])) {
            $query = explode("/",$_GET['query']);
            $libros = bookSearchBy($query[0],$query[1]);
        }

        if (isset($_GET['prestamos'])) {
            $login = $user->toArr()['login'];
            $libros = getBookUserPrestamo( $login );
        }

    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="./styles/style.css">
        <style>
            body{
                background: rgba(0, 0, 0, 0);
                padding-right: 10px;
            }
        </style>
    </head>
    <body>

    <?php 
        if(isset($_SESSION['user'])) {
    ?>
        <table class="custom_table">
            <tr>
                <th>Imagen</th>
                <?php if ($isAdmin) { ?>
                    <th>Id</th>
                <?php } ?>
                <th>Título</th>
                <th>Autor</th>
                <th>Editorial</th>
                <?php if ($isAdmin) { ?>
                    <th>Fecha inserción</th>
                <?php } ?>
                <th>Alquilar</th>
            </tr>
            <?php for ($i=0; $i < count($libros); $i++) { ?>
                <tr>
                    <td class="text_align_center">
                        <img src="<?php echo $libros[$i]->toArr()['imagen'];?>"
                        class="
                            border_radius_10px
                            w100px
                            h100px
                            fit_cover
                            flex
                            flex_v_center
                        ">
                    </td>
                    <?php
                        foreach ($libros[$i]->toArr() as $key) {
                            /** Me salto el campo imagen porque es especial */
                            if ( $key != $libros[$i]->toArr()['imagen'] ) {
                                if ($isAdmin) {
                                    echo "<td>".$key."</td>";
                                }else{
                                    if (
                                        $key != $libros[$i]->toArr()['id'] &&
                                        $key != $libros[$i]->toArr()['fecha']
                                        ) {
                                        echo "<td>".$key."</td>";
                                    }
                                }
                            }
                        }
                        ?>
                        <td class="text_align_center">
                            <a  class="purple nodecoration"
                                href="infolibro?id=<?php echo $libros[$i]->toArr()['id']?>">
                                <div
                                class="
                                box_no_padding
                                fsize20
                                purple
                                fwbold
                                text_align_center
                                pad_top10
                                pad_bottom10
                                pad_left20
                                pad_right20
                                sombra_enlace
                                "
                                >
                                info
                            </div>
                            </a>
                        </td>
                        <?php
                        
                    ?>
                </tr>
            <?php } ?>
            
            <?php if (count($libros)==0) { ?>
                    <tr>
                        <td colspan="<?php if ($isAdmin) { echo 7;}else{echo 5;}?>" class="text_align_center">
                            No se han encontrado libros
                        </td>
                    </tr>
            <?php } ?>  
        </table>
    <?php
        }else{
            new PaginaError(true);
        }
    ?>
    </body>
</html>
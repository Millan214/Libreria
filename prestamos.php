<?php
    /** Inicio la sesión */
    session_start();

    foreach (glob("./controller/addons/*.php") as $filename){
        include $filename;
    }
    foreach (glob("./controller/*.php") as $filename){
        require_once $filename;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Préstamos</title>
        <link rel="stylesheet" href="./styles/style.css">
    </head>
    <body>
        <?php
            if(isset($_SESSION['user'])){
                paginaNormal();
            }else{
                new PaginaError();
            }
        ?>
    </body>
</html>

<?php
    function paginaNormal(){
        ?>
            <div class="pad_left10">
                <h1>jamon</h1>
            </div>
        <?php
    }
?>
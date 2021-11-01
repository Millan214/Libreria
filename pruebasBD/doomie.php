<?php
    $dbHost = "localhost";
    $dbName = "pibd";
    $dbUser = "root";
    $dbPassword = "";

    require_once('../controller/Libro.php');
    require_once('../controller/DB.php');

    $book = new Libro(
        "imagen",
        "0",
        "titulo",
        "autor",
        "editorial",
        "1999-1-1"
    );
    //echo addLibro($book);

?>
<?php

    $dbHost = "localhost";
    $dbName = "pibd";
    $dbUser = "root";
    $dbPassword = "";

    try {
        $dbConn = new PDO(
            "mysql:host=$dbHost;dbname=$dbName",
            $dbUser,
            $dbPassword,
            array(PDO::ATTR_PERSISTENT => true)
        );
    } catch (Exception $error) {
        print_r($error);
    }

?>
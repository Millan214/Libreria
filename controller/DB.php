<?php

    require_once("Mensajes.php");
    require_once("Usuario.php");
    require_once("Libro.php");

    /**
     * @return Array con todos los libros de la biblioteca.
     */
    function getAllBooks(){

            require("initDB.inc.php");

            $libros = [];

            try{

                $dbConn = new PDO(
                    "mysql:host=$dbHost;dbname=$dbName",
                    $dbUser,
                    $dbPassword,
                    array(PDO::ATTR_PERSISTENT => true)
                );
        
                $query = $dbConn->query("select * from libros");
                $libros = [];
                foreach ($query as $row) {
                    array_push($libros,new Libro(
                        $row['imagen'],
                        $row['cod_libro'],
                        $row['titulo'],
                        $row['autor'],
                        $row['editorial'],
                        $row['fecha_insercion']
                    ));
                }

                $query = null;
                $dbConn = null;
                return $libros;
        
            }catch(PDOException $error){
                print_r($error);
                return -1;
            }        

            return -1;
    }

    /**
     * @return boolean true en caso de que el usuario y la contraseña coincidan.
     */
    function checkLogIn($login,$pswd){
        $user = getUserDB($login);

        if (gettype($user) != "integer") {
            if (
                $login == $user->toArr()['login'] &&
                $pswd == getUserPasswordDB($login)
            ) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * @param string            $key        Nombre del atributo a buscar.       ej: "titulo"
     * @param string            $value      Valor del campo del libro a buscar. ej: "bobedas de acero"
     * @return Array[Libro]     $resultado  Resultado de la búsqueda en forma de array de Libros.
     */
    function bookSearchBy(String $key, String $value){

        try{

            require("initDB.inc.php");

            $dbConn = new PDO(
                "mysql:host=$dbHost;dbname=$dbName",
                $dbUser,
                $dbPassword,
                array(PDO::ATTR_PERSISTENT => true)
            );
    
            $query = $dbConn->query("select * from libros where lower($key) like '%$value%'");
            $resultado = [];
            foreach ($query as $row) {
                array_push($resultado,new Libro(
                    $row['imagen'],
                    $row['cod_libro'],
                    $row['titulo'],
                    $row['autor'],
                    $row['editorial'],
                    $row['fecha_insercion']
                ));
            }

            $query = null;
            $dbConn = null;
            return $resultado;
    
        }catch(PDOException $error){
            print_r($error);
            return -1;
        }        

        return -1;
        
        return $resultado;
    }

    function getBookById(String $id){

        try{

            require("initDB.inc.php");

            $dbConn = new PDO(
                "mysql:host=$dbHost;dbname=$dbName",
                $dbUser,
                $dbPassword,
                array(PDO::ATTR_PERSISTENT => true)
            );
    
            $query = $dbConn->query("select * from libros where cod_libro = '$id'");
            foreach ($query as $row) {
                return new Libro(
                    $row['imagen'],
                    $row['cod_libro'],
                    $row['titulo'],
                    $row['autor'],
                    $row['editorial'],
                    $row['fecha_insercion']
                );
            }

            $query = null;
            $dbConn = null;
    
        }catch(PDOException $error){
            print_r($error);
            return -1;
        }        

        return "no hay libros";
        
        return $resultado;
    }

    function isBookAvailable(String $id){
        return true;
    }

    function getUserDB(String $login){
        try {

            require("initDB.inc.php");

            $query = $dbConn->query("select * from usuarios where login = '$login'");
            foreach ($query as $row) {
                return new Usuario($row['login'],$row['nombre'],$row['apellidos'],$row['email'],$row['tipo']);
            }
            $query = null;
            $dbConn = null;
        } catch (PDOException $e) {
            print_r($e);
        }        

        return -1;
    }

    function getUserPasswordDB(String $login){
        try {

            require("initDB.inc.php");

            $query = $dbConn->query("select * from usuarios where login = '$login'");
            foreach ($query as $row) {
                return $row['password'];
            }
            $query = null;
            $dbConn = null;
        } catch (PDOException $e) {
            print_r($e);
        }        

        return -1;
    }

    function bookExists($book){

        $dbBook = getBookById($book->toArr()['id']);
        if ( gettype($dbBook) != "string" ) {
            if (
                $dbBook->toArr()['titulo'] == $book->toArr()['titulo'] &&
                $dbBook->toArr()['autor'] == $book->toArr()['autor'] &&
                $dbBook->toArr()['editorial'] == $book->toArr()['editorial']
            ) {
                return true;
            }
        }
        
        return false;

    }

    function addLibro(Libro $book){
        if ( !bookExists($book) ) {
            try{

                require("initDB.inc.php");
                
                $dbConn->beginTransaction();
                $statement = $dbConn->prepare("insert into libros (titulo,autor,editorial,fecha_insercion,imagen) values (:titulo,:autor,:editorial,:fecha_insercion,:imagen)");

                $statement->bindParam(':titulo', $titulo);
                $statement->bindParam(':autor', $autor);
                $statement->bindParam(':editorial', $editorial);
                $statement->bindParam(':fecha_insercion', $fecha_insercion);
                $statement->bindParam(':imagen', $imagen);

                //insertar una fila
                $titulo = $book->toArr()["titulo"];
                $autor = $book->toArr()["autor"];
                $editorial = $book->toArr()["editorial"];
                $fecha_insercion = $book->toArr()["fecha"];
                $imagen = $book->toArr()["imagen"];

                $statement->execute();

                $dbConn->commit();

                $dbConn = null;

                return 1;

            } catch (PDOException $e) {
                print_r($e);
            }       
        }else{
            return -1;
        }

    }

    function deleteLibro(String $id){
        try{

            require("initDB.inc.php");

            $dbConn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $dbConn->beginTransaction();            

            $dbConn->exec("delete from libros where cod_libro = '$id'");

            $dbConn->commit();
            $dbConn = null;

            return 1;

        } catch (PDOException $e) {
            print_r($e);
        }
        return 0;
    }

    function addUser( Usuario $user, $password ){
        try {
            
            require("initDB.inc.php");

            $dbConn->beginTransaction();
            $statement = $dbConn->prepare("insert into usuarios values (:login,:password,:nombre,:apellidos,:email,:tipo)");

            $statement->bindParam(':login', $login);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':apellidos', $apellidos);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':tipo', $tipo);

            //insertar una fila
            $login = $user->toArr()["login"];
            $password = $password;
            $nombre = $user->toArr()["nombre"];
            $apellidos = $user->toArr()["apellido"];
            $email = $user->toArr()["email"];
            $tipo = $user->toArr()["tipo"];

            $statement->execute();

            $dbConn->commit();

            $dbConn = null;

        } catch (PDOException $e) {
            print_r($e);
        }       
    }

?>
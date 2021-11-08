<?php

    require_once("Mensajes.php");
    require_once("Usuario.php");
    require_once("Libro.php");

    /**
     * Brief:   Obtiene todos los libros.
     * 
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
        
                $query = $dbConn->query("select * from libros where borrado_virtual is null");
                $libros = [];
                foreach ($query as $row) {
                    array_push($libros,new Libro(
                        $row['url_imagen'],
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
     * Brief:   Comprueba que el usuario se corresponde con la contraseña.
     * 
     * @return boolean true en caso de que el usuario y la contraseña coincidan.
     */
    function checkLogIn($login,$pswd){
        try {

            require("initDB.inc.php");

            $query = $dbConn->query("select * from usuarios where login = '$login' and password = '$pswd'");
            foreach ($query as $row) {
                $query = null;
                echo "hola";
                return true;
            }
            $query = null;

            $dbConn = null;
        } catch (PDOException $e) {
            echo "getUserPasswordDB:<br>";
            print_r($e);
        }        

        return false;
    }

    /**
     * Brief:   Realiza una búsqueda simple.
     * 
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
    
            $query = $dbConn->query("select * from libros where lower($key) like '%$value%' and borrado_virtual is null");
            $resultado = [];
            foreach ($query as $row) {
                array_push($resultado,new Libro(
                    $row['url_imagen'],
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

    /**
     * Brief:   Obtiene todos los datos de un libro.
     * 
     * @param   string  $id Codigo del libro a buscar
     * @return  Libro       Objeto Libro con todos los datos del libro correspondiente al parámetro $id
     */
    function getBookById(String $id){

        try{

            require("initDB.inc.php");

            $dbConn = new PDO(
                "mysql:host=$dbHost;dbname=$dbName",
                $dbUser,
                $dbPassword,
                array(PDO::ATTR_PERSISTENT => true)
            );
    
            $query = $dbConn->query("select * from libros where cod_libro = '$id' and borrado_virtual is null");
            foreach ($query as $row) {
                return new Libro(
                    $row['url_imagen'],
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

    /**
     * Brief:   Comprueba si alguien tiene el libro o está disponible.
     * 
     * EXPERIMENTAL         Esta función está en fase de desarrollo, por el momento siempre devuelve TRUE
     * @param   string  $id Codigo del libro a comprovar
     * @return  boolean     True:   si el libro [SI] está disponible
     *                      False:  si el libro [NO] está disponible
     */
    function isBookAvailable(String $id){
        return true;
    }

    /**
     * Brief:   Obtiene tods los datos de un usuario.
     * 
     * @param   string      $login  El login del usuario a buscar
     * @return  Usuario             El usuario con todos los datos correspondientes al $login introducido por parámetro
     */
    function getUserDB(String $login){
        try {

            require("initDB.inc.php");

            $query = $dbConn->query("select * from usuarios where login = '$login'");
            foreach ($query as $row) {
                return new Usuario($row['login'],$row['nombre'],$row['apellido1']." ".$row['apellido2'],$row['email'],$row['tipo']);
            }
            $query = null;
            $dbConn = null;
        } catch (PDOException $e) {
            echo "getUserDB:<br>";
            print_r($e);
        }        

        return -1;
    }

    /**
     * Brief:   Obtiene la contraseña de un usuario.
     * 
     * @param   string  $login      El login del usuario a buscar
     * @return  string              La contraseña del usuario
     *                              La contraseña está hasheada con sha512
     */
    function getUserPasswordDB(String $login){
        try {

            require("initDB.inc.php");

            $query = $dbConn->query("select * from usuarios where login = '$login' and borrado_virtual is null");
            foreach ($query as $row) {
                $query = null;
                return $row['password'];
            }
            $query = null;

            $dbConn = null;
        } catch (PDOException $e) {
            echo "getUserPasswordDB:<br>";
            print_r($e);
        }        

        return -1;
    }

    /**
     * Brief:   Comprueba si un libro existe.
     * 
     * @param   Libro   $book       El libro a buscar
     * @return  boolean             True:   Si el libro [SI] existe
     *                              False:  Si el libro [NO] existe
     */
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

    /**
     * Brief:   Añade un libro a la base de datos.
     * 
     * @param   Libro   $book   Objeto libro con cuyos datos se poblará la base de datos
     */
    function addLibro(Libro $book){
        if ( !bookExists($book) ) {
            try{

                require("initDB.inc.php");

                $dbConn->beginTransaction();
                $statement = $dbConn->prepare("insert into libros (titulo,autor,editorial,fecha_insercion,url_imagen) values (:titulo,:autor,:editorial,NOW(),:imagen)");

                $statement->bindParam(':titulo', $titulo);
                $statement->bindParam(':autor', $autor);
                $statement->bindParam(':editorial', $editorial);
                $statement->bindParam(':imagen', $imagen);

                //insertar una fila
                $titulo = $book->toArr()["titulo"];
                $autor = $book->toArr()["autor"];
                $editorial = $book->toArr()["editorial"];
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

    /**
     * Brief:   "Elimina" un libro de la base de datos
     *          Cambia el campo 'borrado_virtual' a la fecha de hoy, por lo que al no ser null,
     *          ninguna función de este archivo podrá acceder a una tupla con estas características.
     * 
     * @param   string  $id  Codigo del libro a eliminar
     */
    function deleteLibro(String $id){
        try{

            require("initDB.inc.php");

            $dbConn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $dbConn->beginTransaction();            

            $dbConn->exec("update libros set borrado_virtual = NOW() where cod_libro = '$id'");

            $dbConn->commit();
            $dbConn = null;

            return 1;

        } catch (PDOException $e) {
            print_r($e);
        }
        return 0;
    }

    /**
     * Brief:   Añade un usuario a la base de datos.
     * 
     * @param   Usuario     $user       Objeto usuario con el que se poblaran todos los campos de la base de datos menos la contraseña
     * @param   string      $password   Contraseña a introducir en la base de datos
     *                                  La contraseña está hasheada con sha512
     */
    function addUser( Usuario $user, $password ){
        try {
            
            require("initDB.inc.php");

            $dbConn->beginTransaction();
            $statement = $dbConn->prepare("insert into usuarios values (:login,:password,:nombre,:apellidos,null,:email,:tipo,null)");

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

            mensajeExito("Usuario añadido correctamente");

            $dbConn = null;

        } catch (PDOException $e) {
            echo "addUser:<br>";
            echo explode("]: ",$e->getMessage())[1];
            mensajeError("ha sucedido un error");
        }       
    }

    /**
     * Brief:   Presta un libro a un usuario.
     * 
     * @param   string  $login      Login del usuario que quiere pedir el libro.
     * @param   string  $codLibro   Codigo del libro a prestar.
     */
    function prestarLibro( $_login, $_codLibro ){
        try{

            require("initDB.inc.php");
            
            if (!checkLibroPrestado($_login,$_codLibro)) {
                
                $dbConn->beginTransaction();

                $statement = $dbConn->prepare("insert into prestamos ( cod_libro,login,prestado ) values (:codLibro,:login,NOW())");

                $statement->bindParam(':codLibro', $codLibro);
                $statement->bindParam(':login', $login);

                //insertar una fila
                $codLibro = $_codLibro;
                $login = $_login;

                $statement->execute();

                $dbConn->commit();

                $dbConn = null;
                
                return true;

            }

            return false;

        } catch (PDOException $e) {
            print_r($e);
        }
    }

    /**
     * Brief:   Devuelve un libro de un usuario.
     * 
     * @param   string  $login      Login del usuario que quiere pedir el libro.
     * @param   string  $codLibro   Codigo del libro a devolver.
     */
    function devolverLibro( $_login, $_codLibro ){

        try{

            require("initDB.inc.php");

            $dbConn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $dbConn->beginTransaction();            

            $dbConn->exec("update prestamos set devuelto = NOW() where cod_libro = '$_codLibro' and login = '$_login'");

            $dbConn->commit();
            $dbConn = null;

            return true;

        } catch (PDOException $e) {
            print_r($e);
        }
        return false;
    }    

    /**
     * Brief:   Comprueba si el libro dado está prestado por un usuario.
     * 
     * @param   string  $_login     Login del usuario
     * @param   string  $_codLibro  Codigo del libro a buscar
     * @return  boolean             True:   Si el usuario tiene el libro.
     */
    function checkLibroPrestado( $_login, $_codLibro ){
        try {

            require("initDB.inc.php");

            $query = $dbConn->query("select * from prestamos where login = '$_login' and cod_libro = '$_codLibro' and devuelto is null");
            foreach ($query as $row) {
                $query = null;
                $dbConn = null;
                return true;
            }
            $query = null;

            $dbConn = null;
        } catch (PDOException $e) {
            print_r($e);
        }        

        return false;
    }

    /**
     * Brief:   Obtiene los prestamos de un usuario.
     * 
     * @param   string          $login  Login del usuario del que queremos obtener los prestamos
     * @return  Array[Libro]    $arr    Array con los prestamos
     */
    function getBookUserPrestamo( $login ){
        $arr = [];
        try {

            require("initDB.inc.php");
            
            $query = $dbConn->query("select * from libros where cod_libro in ( select cod_libro from prestamos where login = '$login' and devuelto is null );");
            foreach ($query as $row) {
                $query = null;
                array_push( $arr, new Libro(
                        $row['url_imagen'],
                        $row['cod_libro'],
                        $row['titulo'],
                        $row['autor'],
                        $row['editorial'],
                        $row['fecha_insercion']
                    )
                );
            }
            $query = null;

            $dbConn = null;

            return $arr;

        } catch (PDOException $e) {
            print_r($e);
        }        

        return -1;
    }

    /**
     * Brief:   Obtiene los prestamos de un usuario.
     * 
     * @param   string          $login  Login del usuario del que queremos obtener los prestamos
     * @return  Array[Libro]    $arr    Array con los prestamos
     */
    function getAllBookPrestamo( $login ){
        $arr = [];
        try {

            require("initDB.inc.php");
            
            $query = $dbConn->query("select * from libros where cod_libro in ( select cod_libro from prestamos where devuelto is null )");
            foreach ($query as $row) {
                $query = null;
                array_push( $arr, new Libro(
                        $row['url_imagen'],
                        $row['cod_libro'],
                        $row['titulo'],
                        $row['autor'],
                        $row['editorial'],
                        $row['fecha_insercion']
                    )
                );
            }
            $query = null;

            $dbConn = null;
            
            return $arr;

        } catch (PDOException $e) {
            print_r($e);
        }        

        return -1;
    }

    /**
     * Actualiza un libro.
     * @param   string  $_codLibro   Codigo del libro a actualizar
     * @param   string  $_titulo     Titulo del libro
     * @param   string  $_autor      Autor del libro
     */
    function updateLibro($_codLibro, $_titulo, $_autor){
        try{

            require("initDB.inc.php");

            $dbConn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $dbConn->beginTransaction();            

            $dbConn->exec("update libros set titulo='$_titulo', autor='$_autor' where cod_libro='$_codLibro'");

            $dbConn->commit();
            $dbConn = null;

            return true;

        } catch (PDOException $e) {
            print_r($e);
        }
        return false;
    }

    /**
     * Brief:   Obtiene todos los prestamos.
     * 
     * 
     */


?>
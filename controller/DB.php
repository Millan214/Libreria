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

            try {
                $dbConn->beginTransaction();
                $sql = 'select * from libros where borrado_virtual is null';
                $query = $dbConn->prepare($sql);
                $query->execute();
                $dbConn = null;

                //array de libros
                $librosObj = [];

                while($results = $query->fetch()){
                    array_push($librosObj,new Libro(
                        $results['url_imagen'],
                        $results['cod_libro'],
                        $results['titulo'],
                        $results['autor'],
                        $results['editorial'],
                        $results['fecha_insercion']
                    ));
                }

                $query = null;

                return $librosObj;                

            } catch (DOMException $e) {
                print_r($e);
                $dbConn->rollBack();
                $dbConn = null;
                return false;
            }       

            return false;
    }

    /**
     * Brief:   Comprueba que el usuario se corresponde con la contraseña.
     * 
     * @return boolean true en caso de que el usuario y la contraseña coincidan.
     */
    function checkLogIn($login,$pswd){

        require("initDB.inc.php");

        try{

            $dbConn->beginTransaction();
    
            $sql = "select * from usuarios where login = ? and password = ?";
            $sth = $dbConn->prepare($sql);
    
            $sth->execute([$login,$pswd]);

            $dbConn = null;

            return !empty($sth->fetchAll());            
    
        }catch(PDOException $e){
            print_r($e);
            $dbConn->rollBack();
            $dbConn = null;
            return false;
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

        require("initDB.inc.php");

        try{
    
            $dbConn->beginTransaction();
    
            $sql = "desc libros";
            $query = $dbConn->prepare($sql);
            $query->execute();
    
            $keyExists = false;
    
            //obtengo los nombres de las columnas de la tabla libros y los comparo con la key que me han pasado
            while ($results = $query->fetch()){
                if($key == $results[0]){
                    $keyExists = $results[0];
                }
            } 
    
            if($keyExists){
    
                $sql = "select * from libros where $keyExists like concat('%',?,'%') and borrado_virtual is null";
                $query = $dbConn->prepare($sql);
                $query->execute([$value]);
    
                $dbConn = null;
        
                $librosObj = [];
    
                while ($results = $query->fetch()){
                    array_push($librosObj,new Libro(
                        $results['url_imagen'],
                        $results['cod_libro'],
                        $results['titulo'],
                        $results['autor'],
                        $results['editorial'],
                        $results['fecha_insercion']
                    ));
                }
    
                return $librosObj;
    
            }else{
                return [];
            }  
    
        }catch(PDOException $e){
            print_r($e);
            $dbConn->rollBack();
            $dbConn = null;
            return false;
        } 
    }

    /**
     * Brief:   Obtiene todos los datos de un libro.
     * 
     * @param   string  $id Codigo del libro a buscar
     * @return  Libro       Objeto Libro con todos los datos del libro correspondiente al parámetro $id
     */
    function getBookById(String $id){

        require("initDB.inc.php");

        try{

            $dbConn->beginTransaction();
    
            $sql = "select * from libros where cod_libro = ? and borrado_virtual is null";
    
            $query = $dbConn->prepare($sql);
            $dbConn = null;
    
            $query->execute([$id]);
    
            $book = $query->fetchAll()[0];
            
            return new Libro(
                $book['url_imagen'],
                $book['cod_libro'],
                $book['titulo'],
                $book['autor'],
                $book['editorial'],
                $book['fecha_insercion']
            );
    
        }catch(PDOException $error){
            print_r($error);
            $dbConn->rollBack();
            return false;
        }        
    
        return "no hay libros";
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

        require("initDB.inc.php");

        try {

            $dbConn->beginTransaction();

            $sql = "select * from usuarios where login = ?";
            $query = $dbConn->prepare($sql);
            $query->execute([$login]);

            $dbConn = null;

            while($res = $query->fetch()){
                return new Usuario($res['login'],$res['nombre'],$res['apellido1']." ".$res['apellido2'],$res['email'],$res['tipo']);
            }

            $query = null;
            
        } catch (PDOException $e) {
            echo "getUserDB:<br>";
            print_r($e);
            $dbConn->rollBack();
        }        

        return false;
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
                $dbConn->rollBack();
                $dbConn = null;
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

        require("initDB.inc.php");

        try{
            $dbConn->beginTransaction();            
            $sql = "update libros set borrado_virtual = NOW() where cod_libro = :id";
            $query = $dbConn->prepare($sql);
            $query->bindParam(':id',$id);
            
            $query->execute();
            $dbConn->commit();

            $dbConn = null;
            $query = null;

            return true;

        } catch (PDOException $e) {
            print_r($e);
            $dbConn->rollBack();
            $dbConn = null;
        }
        return false;
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

        require("initDB.inc.php");

        try{
            $dbConn->beginTransaction();
            $sql = "update prestamos set devuelto = NOW() where cod_libro = :codLibro and login = :login";
            $query = $dbConn->prepare($sql);

            $query->bindParam(':codLibro',$_codLibro);
            $query->bindParam(':login',$_login);
            
            $query->execute();
            $dbConn->commit();

            $dbConn = null;
            $query = null;

            return true;

        } catch (PDOException $e) {
            print_r($e);
            $dbConn->rollBack();
            $dbConn = null;
            return false;
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

        require("initDB.inc.php");

        try {

            $dbConn->beginTransaction();

            $sql = "select * from prestamos where login = ? and cod_libro = ? and devuelto is null";
            $query = $dbConn->prepare($sql);
            $query->execute([$_login,$_codLibro]);

            $dbConn = null;

            return !empty($query->fetchAll());

            $query = null;
            
        } catch (PDOException $e) {
            echo "getUserDB:<br>";
            print_r($e);
            $dbConn->rollBack();
            $dbConn = null;
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

        require("initDB.inc.php");

        try {
            $dbConn->beginTransaction();
            $sql = "select * from libros where cod_libro in ( select cod_libro from prestamos where login = ? and devuelto is null )";
            $query = $dbConn->prepare($sql);
            $query->execute([$login]);
            $dbConn = null;

            //array de libros
            $librosObj = [];

            while($results = $query->fetch()){
                array_push($librosObj,new Libro(
                    $results['url_imagen'],
                    $results['cod_libro'],
                    $results['titulo'],
                    $results['autor'],
                    $results['editorial'],
                    $results['fecha_insercion']
                ));
            }

            $query = null;

            return $librosObj;                

        } catch (DOMException $e) {
            print_r($e);
            $dbConn->rollBack();
            $dbConn = null;
            return false;
        }       

        return false;
    }

    /**
     * Brief:   Obtiene todos los prestamos. (de momento no se usa)
     * 
     * @return  Array[Libro]    $arr    Array con los prestamos
     */
    function getAllBookPrestamo(){

        require("initDB.inc.php");

        try {
            $dbConn->beginTransaction();
            $sql = "select * from libros where cod_libro in ( select cod_libro from prestamos where devuelto is null )";
            $query = $dbConn->prepare($sql);
            $query->execute();
            $dbConn = null;

            //array de libros
            $librosObj = [];

            while($results = $query->fetch()){
                array_push($librosObj,new Libro(
                    $results['url_imagen'],
                    $results['cod_libro'],
                    $results['titulo'],
                    $results['autor'],
                    $results['editorial'],
                    $results['fecha_insercion']
                ));
            }

            $query = null;

            return $librosObj;                

        } catch (DOMException $e) {
            print_r($e);
            $dbConn->rollBack();
            $dbConn = null;
            return false;
        }       

        return false;
    }

    /**
     * Actualiza un libro.
     * @param   string  $_codLibro   Codigo del libro a actualizar
     * @param   string  $_titulo     Titulo del libro
     * @param   string  $_autor      Autor del libro
     */
    function updateLibro($_codLibro, $_titulo, $_autor){

        require("initDB.inc.php");

        try{

            $dbConn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $dbConn->beginTransaction();     
            
            $sql = "update libros set titulo= :titulo, autor= :autor where cod_libro= :codLibro";
            $query = $dbConn->prepare($sql);
            
            $query->bindParam(':titulo',$_titulo);
            $query->bindParam(':codLibro',$_codLibro);
            $query->bindParam(':autor',$_autor);

            $query->execute();

            $dbConn->commit();

            $dbConn = null;
            $query = null;

            return true;

        } catch (PDOException $e) {
            print_r($e);
            $dbConn->rollBack();
            $dbConn = null;
            return false;
        }
        return false;

    }


    function compruebaRecordar($login, $idSesion){

        require("initDB.inc.php");

        try {
            
            $dbConn->beginTransaction();

            $sql = "select * from usuarios where login=? and ID_session=?";

            $query = $dbConn->prepare($sql);

            $query->execute([$login,$idSesion]);

            $dbConn = null;

            return !empty($query->fetchAll());

        } catch (PDOException $e) {
            $dbConn->rollBack();
            $dbConn = null;
            return false;
        }

    }

    function updateSessionID($login, $idSesion){
        require("initDB.inc.php");

        try{

            $dbConn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $dbConn->beginTransaction();     
            
            $sql = "update usuarios set ID_session= :idSesion where login= :login";
            $query = $dbConn->prepare($sql);
            
            $query->bindParam(':idSesion',$idSesion);
            $query->bindParam(':login',$login);

            $query->execute();

            $dbConn->commit();

            $dbConn = null;
            $query = null;

            return true;

        } catch (PDOException $e) {
            print_r($e);
            $dbConn->rollBack();
            $dbConn = null;
            return false;
        }
        return false;
    }

?>
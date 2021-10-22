<?php
    class Usuario{

        /**
         * @return string Devuelve los argumentos que pide el constructor
         */
        public static function getArgs(){
            return "login, password, nombre, apellido, email, tipo";
        }

        private $login = "nd";
        private $nombre = "nd";
        private $apellido = "nd";
        private $email = "nd";
        private $tipo = "nd";

        /**
         * El constructor.
         * @param string $_login PK     El nombre con el que se registra el usuario.
         * La contraseña no es información util, no la vamos a utilizar.
         * @param string $_nombre       El nombre del usuario.
         * @param string $_apellido     El primer apellido del usuario.
         * @param string $_email        El correo del usuario.
         * @param int    $tipo          1 si el usuario es administrador, 0 si no lo es.
         */
        public function __construct($_login, $_nombre, $_apellido, $_email, $_tipo){
            $this->login = $_login;
            $this->nombre = $_nombre;
            $this->apellido = $_apellido;
            $this->email = $_email;
            $this->tipo = $_tipo;
        }

        /**
         * En ved de hacer muchos getter creo una función que me pasa el objeto a array.
         * Este array es el que utilizo para obtener los datos.
         * @return Array con todos los atributos.
         */
        public function toArr(){
            return [
                "login" => $this->login,
                "nombre" => $this->nombre,
                "email" => $this->email,
                "tipo" => $this->tipo
            ];
        }

        /**
         * @return boolean Comprueba si el usuario es administrador o no
         */
        public function isAdmin(){
            if ($this->tipo == 0) {
                return false;
            }else{
                return true;
            }            
        }

        /**
         * @return Array con los libros correspondientes a ese usuario.
         */
        function getBooks(){
            $libros = [];

            for ($i=0; $i < 20; $i++) { 
                array_push($libros,new Libro(
                    "./img/asimov-fundacion.jpg",
                    "1",
                    "El fin de la eternidad",
                    "Isaac Asimov",
                    "Best Seller",
                    "30/04/2020"
                ));
            }

            return $libros;
        }

    }
?>
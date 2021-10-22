<?php

    require_once("Mensajes.php");

    class DB{
        
        /**
         * @return Array con todos los libros de la biblioteca.
         */
        public static function getAllBooks(){
            $libros = [];

            array_push($libros,new Libro(
                "./img/el-fin-de-la-eternidad.jpg",
                "1",
                "El fin de la eternidad",
                "Isaac Asimov",
                "Best Seller",
                "30/04/2020"
            ));

            array_push($libros,new Libro(
                "./img/preludio-a-la-fundacion.jpg",
                "2",
                "Preludio a la fundación",
                "Isaac Asimov",
                "Best Seller",
                "20/03/2019"
            ));  
            
            array_push($libros,new Libro(
                "./img/yo-robot.jpg",
                "3",
                "Yo, Robot",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1950"
            ));

            array_push($libros,new Libro(
                "./img/bobedas-de-acero.jpg",
                "4",
                "Bobedas de acero",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1954"
            ));

            array_push($libros,new Libro(
                "./img/el-sol-desnudo.jpg",
                "5",
                "El sol desnudo",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1957"
            ));

            array_push($libros,new Libro(
                "./img/los-robots-del-amanecer.jpg",
                "6",
                "Los robots del amanecer",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1983"
            ));

            array_push($libros,new Libro(
                "./img/robots-e-imperio.jpg",
                "7",
                "Robots e Imperio",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1985"
            ));

            array_push($libros,new Libro(
                "./img/en-la-arena-estelar.jpg",
                "8",
                "En la arena estelar",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1951"
            ));

            array_push($libros,new Libro(
                "./img/las-corrientes-del-espacio.jpg",
                "9",
                "Las corrientes del espacio",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1952"
            ));

            array_push($libros,new Libro(
                "./img/un-guijarro-en-el-cielo.jpg",
                "10",
                "Un guijarro en el cielo",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1950"
            ));

            array_push($libros,new Libro(
                "./img/hacia-la-fundacion.jpg",
                "11",
                "Hacia la fundacion",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1993"
            ));

            array_push($libros,new Libro(
                "./img/fundacion.jpg",
                "12",
                "Fundación",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1951"
            ));

            array_push($libros,new Libro(
                "./img/fundacion-e-imperio.jpg",
                "13",
                "Fundación e Imperio",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1952"
            ));

            array_push($libros,new Libro(
                "./img/segunda-fundacion.jpg",
                "14",
                "Segunda Fundación",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1953"
            ));

            array_push($libros,new Libro(
                "./img/los-limites-de-la-fundacion.jpg",
                "15",
                "Los limites de la fundacion",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1982"
            ));

            array_push($libros,new Libro(
                "./img/fundacion-y-tierra.jfif",
                "16",
                "Fundacion y tierra",
                "Isaac Asimov",
                "Best Seller",
                "30/04/1986"
            ));

            array_push($libros,new Libro(
                "./img/amanecer-rojo.jpg",
                "17",
                "Amanecer rojo",
                "Pierce Brown",
                "RBA",
                "30/04/2014"
            ));

            array_push($libros,new Libro(
                "./img/hijo-dorado.jpg",
                "18",
                "Hijo dorado",
                "Pierce Brown",
                "RBA",
                "30/04/2015"
            ));

            array_push($libros,new Libro(
                "./img/manana-azul.jpg",
                "19",
                "Mañana azul",
                "Pierce Brown",
                "RBA",
                "30/04/2017"
            ));

            array_push($libros,new Libro(
                "./img/oro-y-ceniza.jpg",
                "20",
                "Oro y ceniza",
                "Pierce Brown",
                "RBA",
                "30/04/2020"
            ));

            array_push($libros,new Libro(
                "./img/en-las-montanas-de-la-locura.jpg",
                "21",
                "En las montañas de la locura",
                "H.P. Lovecraft",
                "Minotauro",
                "30/04/1936"
            ));

            array_push($libros,new Libro(
                "./img/1984.jpg",
                "22",
                "1984",
                "George Orwell",
                "RBA",
                "30/04/1949"
            ));

            array_push($libros,new Libro(
                "./img/dune.jpg",
                "23",
                "Dune",
                "Frank Herberts",
                "Debolsillo",
                "30/04/1965"
            ));

            array_push($libros,new Libro(
                "./img/guia-del-autoestopista-galactico.jpg",
                "24",
                "Guía del autoestopista galáctico",
                "Douglas Adams",
                "Anagrama",
                "30/04/1979"
            ));

            array_push($libros,new Libro(
                "./img/el-problema-de-los-tres-cuerpos.jpg",
                "25",
                "El problema de los tres cuerpos",
                "Liu Cixin",
                "RBA",
                "30/04/2006"
            ));

            array_push($libros,new Libro(
                "./img/illuminae.jpg",
                "26",
                "ILLUMINAE. Expediente_01",
                "Amie Kaufman",
                "ALFAGUARA",
                "30/04/2017"
            ));

            array_push($libros,new Libro(
                "./img/gemina.jpg",
                "27",
                "GEMINA. Expediente_02",
                "Amie Kaufman",
                "Oneworld Publications",
                "30/04/2018"
            ));

            array_push($libros,new Libro(
                "./img/obsidio.jpg",
                "28",
                "OBSIDIO. Expediente_03",
                "Amie Kaufman",
                "Oneworld Publications",
                "30/04/2019"
            ));

            return $libros;
        }

        /**
         * @return boolean true en caso de que el usuario y la contraseña coincidan.
         */
        public static function checkLogIn($login,$pswd){
            $user = self::getUserDB($login);
            if (
                $login == $user->toArr()['login'] &&
                $pswd == self::getUserPasswordDB($login)
            ) {
                return true;
            }
            return false;
        }

        /**
         * @param string            $key        Nombre del atributo a buscar.       ej: "titulo"
         * @param string            $value      Valor del campo del libro a buscar. ej: "bobedas de acero"
         * @return Array[Libro]     $resultado  Resultado de la búsqueda en forma de array de Libros.
         */
        public static function searchBy($key, $value){

            /** Obtenemos todos los libros */
            $libros = self::getAllBooks();

            /** Definimos el array en el que vamos a guardar los libros resultantes */
            $resultado = [];

            /** Búsqueda literal */
            foreach ($libros as $libro) {
                if ($libro->toArr()[$key] == $value ) {
                    array_push($resultado,$libro);
                }
            }

            return $resultado;

        }

        public static function getBookById($id){
            $libros = self::getAllBooks();
            foreach ($libros as $libro) {
                if ($libro->toArr()['id'] == $id) {
                    return $libro;
                }
            }
            return "no hay libros";
        }

        public static function isBookAvailable($id){
            return true;
        }

        public static function getUserDB($login){
            //TODO: Cosas con la base de datos
            return new Usuario("pepito123","Pepe","Martinez","pepito@gmail.com",1);
        }

        public static function getUserPasswordDB($login){
            return "263fec58861449aacc1c328a4aff64aff4c62df4a2d50b3f207fa89b6e242c9aa778e7a8baeffef85b6ca6d2e7dc16ff0a760d59c13c238f6bcdc32f8ce9cc62";
        }

        public static function addLibro($book){
            //mensajeError("");
            //mensajeExito("");
        }

    }
?>
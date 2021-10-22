<?php
/**
     * Esta clase la voy a utilizar para estructurar y mostrar los datos de los libros.
     */
    class Libro{

        /**
         * @return string Devuelve los argumentos que pide el constructor
         */
        public static function getArgs(){
            return "imagen, id, titulo, autor, editorial, fecha";
        }

        /** 
         * Declaramos las variables como privadas
         * nd = 'NO DATA'
         */
        private $imagen = "nd";
        private $id = "nd";
        private $titulo = "nd";
        private $autor = "nd";
        private $editorial = "nd";
        private $fecha = "nd";

        /**
         * El constructor
         * @param string $_imagen: La url de la imagen.
         * @param string $_id: La url de la imagen.
         * @param string $_titulo: El título del libro.
         * @param string $_autor: El autor del libro.
         * @param string $_editorial: La editorial del libro.
         * @param string $_fecha: La fecha de inserción del libro.
         */
        public function __construct($_imagen, $_id, $_titulo, $_autor, $_editorial, $_fecha){
            $this->imagen = $_imagen;
            $this->id = $_id;
            $this->titulo = $_titulo;
            $this->autor = $_autor;
            $this->editorial = $_editorial;
            $this->fecha = $_fecha;
        }

        /**
         * En ved de hacer muchos getter creo una función que me pasa el objeto a array.
         * Este array es el que utilizo para obtener los datos.
         * @return Array con todos los atributos.
         */
        public function toArr(){
            return [
                "imagen" => $this->imagen,
                "id" => $this->id,
                "titulo" => $this->titulo,
                "autor" => $this->autor,
                "editorial" => $this->editorial,
                "fecha" => $this->fecha
            ];
        }

    }
?>
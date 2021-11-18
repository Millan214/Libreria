<?php 
    class LeftBar{

        private $isAdmin;

        public function __construct($_isAdmin){
            ?>
                <div class="box_no_padding pad20px marg10px">
                    <h1 class="margin0 fsize30 pad_top10 pad_bottom10 pad_left30 pad_right30 purple">CATÁLOGO</h1>
                    <hr class="border_purple border_solid border_w_2px border_radius_100px">
                    <div class="flex flex_col">
                        <div class="flex_v_center">
                                <svg width="22" height="14" viewBox="0 0 22 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.9999 13.2703C10.6057 13.2703 10.2114 13.1198 9.91082 12.8193L0.451311 3.35969C-0.150437 2.75794 -0.150437 1.78231 0.451311 1.1808C1.05282 0.579299 2.02825 0.579299 2.63005 1.1808L10.9999 9.55118L19.3699 1.1811C19.9716 0.579592 20.947 0.579592 21.5484 1.1811C22.1505 1.7826 22.1505 2.75823 21.5484 3.35998L12.0891 12.8196C11.7883 13.1201 11.3941 13.2703 10.9999 13.2703Z" fill="black"/>
                                </svg>
                                <span class="fsize30">Buscar por</span>
                        </div>
                        <div class="flex flex_col margin_left_20px">
                            <?php if ($_isAdmin) { ?>
                                <div class="fsize20">
                                    <input type="radio" name="seach_by_radios" value="cod_libro">
                                    <label for="sechById">Cod Libro</label>
                                </div>
                            <?php } ?>
                            <div class="fsize20">
                                <input type="radio" name="seach_by_radios" value="titulo" checked>
                                <label for="sechByTitulo">Titulo</label>
                            </div>
                            <div class="fsize20">
                                <input type="radio" name="seach_by_radios" value="autor">
                                <label for="sechByAutor">Autor</label>
                            </div>
                            <div class="fsize20">
                                <input type="radio" name="seach_by_radios" value="editorial">
                                <label for="sechByEditorial">Editorial</label>
                            </div>
                            <?php if ($_isAdmin) { ?>
                                <div class="fsize20">
                                    <input type="radio" name="seach_by_radios" value="fecha_insercion">
                                    <label for="sechByEditorial">Fecha</label>
                                </div>
                            <?php } ?>
                        </div>
                        <a href="./tabla?prestamos=prestamos" target="mainframe"
                            class="nodecoration round_button flex flex_v_center flex_h_center marg_top20px"
                        >
                            Préstamos
                        </a>
                    </div>
                </div>
            <?php
        }
    }
?>
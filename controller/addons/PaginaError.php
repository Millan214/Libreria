<!-- PÁGINA ERROR -->
<?php 
    class PaginaError{
        /**
         * @param boolean $_bg true si quieres background, false si no
         */
        public function __construct($_bg = ""){
            ?>
                <div class="w100 h100 flex flex_v_center flex_h_center flex_col <?php if($_bg){echo "bgpurple_blur";} ?>">
                    <img src="./img/confused-wth.gif" alt="">
                    <h1 class="fsize30 purple text_align_center">
                        HEY! <br>
                        Primero te tienes que registrar
                    </h1>
                </div>
            <?php
        }
    }
?>

<?php
    class TopBar{

        private $isAdmin;

        public function __construct($_isAdmin){
            if (isset($_POST['salir'])) {
                session_destroy();
                header('Location: ./');
            }
            ?>
                <div class="box_no_padding pad10px marg10px flex pad_right20">
                    <input type="submit" name="salir" value="Salir"
                    class="
                        sombra_enlace
                        pad_left20
                        pad_right20
                        flex
                        flex_v_center
                        box_no_padding
                        margin_bottom_10px
                        border_radius_200px
                        nodecoration
                        fsize30
                        purple
                        fwbold
                        margin_right_10px
                        "
                    >
                    <!-- SUDO -->
                        <?php if ($_isAdmin) { ?>
                            <div class="flex flex_v_center margin_left_20px">
                                <span class="
                                    bgpink
                                    white
                                    fsize20
                                    pad_left30
                                    pad_right30
                                    pad_top5
                                    pad_bottom5
                                    "
                                >
                                    ADMIN
                                </span>
                            </div>
                        <?php } ?>
                    <!-- / SUDO -->
                    <div class="flex w100 flex_end flex_v_center">
                        <svg width="50" height="50" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M43.4624 40.871L30.95 28.3586C33.3737 25.3648 34.833 21.5606 34.833 17.4174C34.833 7.81447 27.0193 0.000854492 17.4164 0.000854492C7.81353 0.000854492 0 7.81439 0 17.4173C0 27.0202 7.81362 34.8338 17.4165 34.8338C21.5598 34.8338 25.3639 33.3745 28.3577 30.9509L40.8701 43.4632C41.2276 43.8207 41.6969 44.0004 42.1663 44.0004C42.6357 44.0004 43.105 43.8207 43.4625 43.4632C44.1793 42.7464 44.1793 41.5878 43.4624 40.871ZM17.4165 31.1672C9.83391 31.1672 3.66666 24.9999 3.66666 17.4173C3.66666 9.83467 9.83391 3.66743 17.4165 3.66743C24.9991 3.66743 31.1664 9.83467 31.1664 17.4173C31.1664 24.9999 24.9991 31.1672 17.4165 31.1672Z" fill="#4361EE"/>
                        </svg>

                        <input type="text" name="input_busqueda" autocomplete="off" placeholder="Búsqueda..." class="input_text" spellcheck="false">

                        <div 
                            id="seachby_button"
                            class="
                            sombra_enlace
                            flex
                            flex_h_center flex_v_center
                            h50px w50px 
                            box_no_padding 
                            border_radius_100px">
                            <svg width="29" height="16" viewBox="0 0 29 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.0862 15.0864C13.5656 15.5655 14.1944 15.8056 14.8232 15.8056C15.4517 15.8056 16.0805 15.5661 16.5601 15.0868L28.2321 3.41459C29.492 2.15467 28.5996 0.000423254 26.8179 0.000398609L2.82848 6.67876e-05C1.04667 4.21415e-05 0.154312 2.15433 1.41424 3.41428L13.0862 15.0864Z" fill="#4361EE"/>
                            </svg>
                        </div>

                        <input autofocus type="submit" value="Buscar" name="buscar_submit" class="sombra_enlace box_no_padding margin_left_20px pad10px pad_left30 pad_right30 fsize30 purple fwbold marg10px"></input>
                    </div>
                </div>
            <?php
        }

    }
?>
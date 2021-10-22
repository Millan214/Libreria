<?php
    function mensajeError($text){
?>
        <div class="
            position_absolute
            w100
            bgred
            zindex2
            text_align_center
            border_bottom_5px
            border_style_darkred
            ">
            <p class="white fsize30">
                <?php echo $text; ?>
            </p>
        </div>
<?php
    }
?>

<?php
    function mensajeExito($text){
?>
        <div class="position_absolute w100 bggreen zindex2 text_align_center border_bottom_5px border_style_darkgreen">
            <p class="white fsize30">
                <?php echo $text; ?>
            </p>
        </div>
<?php
    }
?>
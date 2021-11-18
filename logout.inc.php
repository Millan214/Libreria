<?php
    session_unset();
    session_destroy();
    setcookie("login",$_POST['login'],time()-1);
    setcookie("id_sesion",session_id(),time()-1);
    header('Location: ./');
?>
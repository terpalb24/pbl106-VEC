<?php
    session_start();
    session_unset();
    session_destroy();
    /*setcookie('id', '', -1, '/');
    setcookie('key', '', -1, '/');*/
    header('location: ../')
?>
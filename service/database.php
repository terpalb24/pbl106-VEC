<?php

    $hostname = "localhost";
    $username = "ltewezcf_vec";
    $password = "Bima@1123000";
    $database_name = "ltewezcf_vec";

    $db = mysqli_connect($hostname, $username, $password, $database_name);

    if($db -> connect_error){
        echo "Konesi Gagal";
        die('error');
    };

    session_start();
?>
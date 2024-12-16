<?php

function check_login(){
    if(!isset($_SESSION['isLogin'])) {
        header("location: ../login");
    }
}

function check_logout(){
    
    if(isset($_SESSION['isLogin'])) {
        header("location: ../dashboard");
    }
}
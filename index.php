<?php
//ctr+alt+t pour créer des regions
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["userType"])){
    $_SESSION["userType"]=0;
}
if(!isset($_SESSION["cart"])){
    $_SESSION["cart"]=array();
}
require 'controler/controler.php';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case "snows":
            fillSnows();
            break;
        case "openLogin":
            require "view/loginView.php";
            break;
        case 'login' :
            login($_POST);
            break;
        case "logout":
            logout();
            break;
        case "openRegister":
            require "view/register.php";
            break;
        case "register":
            register($_POST);
            break;
        case "DemanderLoc":
            demanderLoc($_GET["code"]);
            break;
        case "openPanier":
            require "view/loginView.php";
            break;
        case "updateCart":
            addOnCart($_GET["code"],$_POST);
            break;
        default :
            sendHome();
            break;
    }
} else {
    sendHome();
}
?>
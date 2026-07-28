<?php

session_start();

if (!isset($_SESSION['id'])) {

    header("Location: /MegaStore/views/login.php");
    exit;

}

if ($_SESSION['rol'] != 1) {

    header("Location: /MegaStore/views/inicio.php");
    exit;

}
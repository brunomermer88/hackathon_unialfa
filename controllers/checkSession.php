<?php
session_start();
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
if(!isset($_SESSION['codUsuario']) && !isset($_SESSION['tipo'])){
    header("Location: ../views/login.html");
    die();
}
?>
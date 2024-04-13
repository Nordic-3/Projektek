<?php
include_once "osztalyok.php";  //serialize() miatt
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}
$felhasznalo = $_SESSION["user"];
if (!$felhasznalo->isAdmin()){
    header("Location: error.php");
    exit();
}
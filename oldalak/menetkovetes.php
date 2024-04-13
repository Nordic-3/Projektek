<?php
include_once "osztalyok.php";  //serialize() miatt
include_once "fuggvenyek.php";
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}
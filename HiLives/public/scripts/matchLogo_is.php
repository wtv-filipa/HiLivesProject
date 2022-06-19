<?php
require_once("../connections/connection.php");

if (isset($_GET["person"])) {
    $idUser = $_GET["person"];

    include "matchPerson.php";
    header("Location: ../is/pages/homePerson.php");
} else if (isset($_GET["hei"])) {
    $idUser = $_GET["hei"];

    include "matchHei.php";
    header("Location: ../is/pages/homeHei.php");
} else if (isset($_GET["comp"])) {
    $idUser = $_GET["comp"];
    
    include "matchComp.php";
    header("Location: ../is/pages/homeComp.php");
}

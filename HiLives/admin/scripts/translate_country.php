<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idcountry = $_GET["country"];

$query = "UPDATE country
SET name_country = ?, name_country_en = ?, name_country_es = ?, name_country_be = ?, name_country_is = ?
WHERE idcountry = ?";

if (isset($_GET["country"])) {

    $idcountry = $_GET["country"];

    $name = $_POST["name"];
    $name_en = $_POST["name_en"];
    $name_es = $_POST["name_es"];
    $name_be = $_POST["name_be"];
    $name_is = $_POST["name_is"];


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $name_en, $name_es, $name_be, $name_is, $idcountry);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../country_t.php");
            $_SESSION["country"] = 2;
        } else {
            header("Location: ../country_t.php");
            $_SESSION["country"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../country_t.php");
        $_SESSION["country"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../country_t.php");
    $_SESSION["country"] = 2;
}

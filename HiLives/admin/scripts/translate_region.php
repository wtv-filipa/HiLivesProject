<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idregion = $_GET["region"];

$query = "UPDATE region
SET name_region = ?, name_region_en = ?, name_region_es = ?, name_region_be = ?, name_region_is = ?
WHERE idregion = ?";

if (isset($_GET["region"])) {

    $idregion = $_GET["region"];

    $name = $_POST["name"];
    $name_en = $_POST["name_en"];
    $name_es = $_POST["name_es"];
    $name_be = $_POST["name_be"];
    $name_is = $_POST["name_is"];


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $name_en, $name_es, $name_be, $name_is, $idregion);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../region_t.php");
            $_SESSION["region"] = 2;
        } else {
            header("Location: ../region_t.php");
            $_SESSION["region"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../region_t.php");
        $_SESSION["region"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../region_t.php");
    $_SESSION["region"] = 2;
}

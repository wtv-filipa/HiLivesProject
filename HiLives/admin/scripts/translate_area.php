<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idareas = $_GET["area"];

$query = "UPDATE areas
SET name_interested_area = ?, name_interested_area_en = ?, name_interested_area_es = ?, name_interested_area_be = ?, name_interested_area_is = ?
WHERE idareas = ?";

if (isset($_GET["area"])) {

    $idareas = $_GET["area"];

    $name = $_POST["name"];
    $name_en = $_POST["name_en"];
    $name_es = $_POST["name_es"];
    $name_be = $_POST["name_be"];
    $name_is = $_POST["name_is"];


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $name_en, $name_es, $name_be, $name_is, $idareas);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../areas_t.php");
            $_SESSION["area"] = 2;
        } else {
            header("Location: ../areas_t.php");
            $_SESSION["area"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../areas_t.php");
        $_SESSION["area"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../areas_t.php");
    $_SESSION["area"] = 2;
}

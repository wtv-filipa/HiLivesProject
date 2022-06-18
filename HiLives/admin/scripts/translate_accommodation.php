<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idaccommodation = $_GET["ac"];

$query = "UPDATE accommodation
SET name_accommodation = ?, name_accommodation_en = ?, name_accommodation_es = ?, name_accommodation_be = ?, name_accommodation_is = ?
WHERE idaccommodation = ?";

if (isset($_GET["ac"])) {

    $idaccommodation = $_GET["ac"];

    $name = $_POST["name"];
    $name_en = $_POST["name_en"];
    $name_es = $_POST["name_es"];
    $name_be = $_POST["name_be"];
    $name_is = $_POST["name_is"];


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $name_en, $name_es, $name_be, $name_is, $idaccommodation);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../accommodation_t.php");
            $_SESSION["ac"] = 2;
        } else {
            header("Location: ../accommodation_t.php");
            $_SESSION["ac"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../accommodation_t.php");
        $_SESSION["ac"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../accommodation_t.php");
    $_SESSION["ac"] = 2;
}

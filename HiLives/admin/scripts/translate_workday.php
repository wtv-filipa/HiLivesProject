<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idworkday = $_GET["work"];

$query = "UPDATE workday
SET workday_name = ?, workday_name_en = ?, workday_name_es = ?, workday_name_be = ?, workday_name_is = ?
WHERE idworkday = ?";

if (isset($_GET["work"])) {

    $idworkday = $_GET["work"];

    $name = $_POST["name"];
    $name_en = $_POST["name_en"];
    $name_es = $_POST["name_es"];
    $name_be = $_POST["name_be"];
    $name_is = $_POST["name_is"];


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $name_en, $name_es, $name_be, $name_is, $idworkday);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../workday_t.php");
            $_SESSION["work"] = 2;
        } else {
            header("Location: ../workday_t.php");
            $_SESSION["work"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../workday_t.php");
        $_SESSION["work"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../workday_t.php");
    $_SESSION["work"] = 2;
}

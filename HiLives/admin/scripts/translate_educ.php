<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$ideduc_lvl = $_GET["educ"];

$query = "UPDATE educ_lvl
SET name_education = ?, name_education_en = ?, name_education_es = ?, name_education_be = ?, name_education_is = ?
WHERE ideduc_lvl = ?";

if (isset($_GET["educ"])) {

    $ideduc_lvl = $_GET["educ"];

    $name = $_POST["name"];
    $name_en = $_POST["name_en"];
    $name_es = $_POST["name_es"];
    $name_be = $_POST["name_be"];
    $name_is = $_POST["name_is"];


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $name_en, $name_es, $name_be, $name_is, $ideduc_lvl);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../educ_t.php");
            $_SESSION["educ"] = 2;
        } else {
            header("Location: ../educ_t.php");
            $_SESSION["educ"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../educ_t.php");
        $_SESSION["educ"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../educ_t.php");
    $_SESSION["educ"] = 2;
}

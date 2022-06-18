<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idinstitution_type = $_GET["institution"];

$query = "UPDATE institution_type
SET name_institution_type = ?, name_institution_type_en = ?, name_institution_type_es = ?, name_institution_type_be = ?, name_institution_type_is = ?
WHERE idinstitution_type = ?";

if (isset($_GET["institution"])) {

    $idinstitution_type = $_GET["institution"];

    $name = $_POST["name"];
    $name_en = $_POST["name_en"];
    $name_es = $_POST["name_es"];
    $name_be = $_POST["name_be"];
    $name_is = $_POST["name_is"];


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $name_en, $name_es, $name_be, $name_is, $idinstitution_type);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../institution_t.php");
            $_SESSION["institution"] = 2;
        } else {
            header("Location: ../institution_t.php");
            $_SESSION["institution"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../institution_t.php");
        $_SESSION["institution"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../institution_t.php");
    $_SESSION["institution"] = 2;
}

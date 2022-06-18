<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idlearning_type = $_GET["learn"];

$query = "UPDATE learning_type
SET name_learning = ?, name_learning_en = ?, name_learning_es = ?, name_learning_be = ?, name_learning_is = ?
WHERE idlearning_type = ?";

if (isset($_GET["learn"])) {

    $idlearning_type = $_GET["learn"];

    $name = $_POST["name"];
    $name_en = $_POST["name_en"];
    $name_es = $_POST["name_es"];
    $name_be = $_POST["name_be"];
    $name_is = $_POST["name_is"];


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $name_en, $name_es, $name_be, $name_is, $idlearning_type);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../learn_t.php");
            $_SESSION["learn"] = 2;
        } else {
            header("Location: ../learn_t.php");
            $_SESSION["learn"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../learn_t.php");
        $_SESSION["learn"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../learn_t.php");
    $_SESSION["learn"] = 2;
}

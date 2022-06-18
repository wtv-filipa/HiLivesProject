<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idwork_environment = $_GET["env"];

$query = "UPDATE work_environment
SET name_environment = ?, name_environment_en = ?, name_environment_es = ?, name_environment_be = ?, name_environment_is = ?
WHERE idwork_environment = ?";

if (isset($_GET["env"])) {

    $idwork_environment = $_GET["env"];

    $name = $_POST["name"];
    $name_en = $_POST["name_en"];
    $name_es = $_POST["name_es"];
    $name_be = $_POST["name_be"];
    $name_is = $_POST["name_is"];


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $name_en, $name_es, $name_be, $name_is, $idwork_environment);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../environment_t.php");
            $_SESSION["env"] = 2;
        } else {
            header("Location: ../environment_t.php");
            $_SESSION["env"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../environment_t.php");
        $_SESSION["env"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../environment_t.php");
    $_SESSION["env"] = 2;
}

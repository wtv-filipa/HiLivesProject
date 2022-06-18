<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idcourse_regime = $_GET["regime"];

$query = "UPDATE course_regime
SET name_regime = ?, name_regime_en = ?, name_regime_es = ?, name_regime_be = ?, name_regime_is = ?
WHERE idcourse_regime = ?";

if (isset($_GET["regime"])) {

    $idcourse_regime = $_GET["regime"];

    $name = $_POST["name"];
    $name_en = $_POST["name_en"];
    $name_es = $_POST["name_es"];
    $name_be = $_POST["name_be"];
    $name_is = $_POST["name_is"];


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $name_en, $name_es, $name_be, $name_is, $idcourse_regime);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../regime_t.php");
            $_SESSION["regime"] = 2;
        } else {
            header("Location: ../regime_t.php");
            $_SESSION["regime"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../regime_t.php");
        $_SESSION["regime"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../regime_t.php");
    $_SESSION["regime"] = 2;
}

<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idDone_CU = $_GET["uc"];

$query = "UPDATE done_cu
SET cu_name = ?, cu_name_en = ?, cu_name_es = ?, cu_name_be = ?, cu_name_is = ?, university_name = ?, university_name_en = ?, university_name_es = ?, university_name_be = ?, university_name_is = ?
WHERE iddone_cu = ?";

if (isset($_GET["uc"])) {

    $idDone_CU = $_GET["uc"];
    $nomeuc = $_POST["nomeuc"];
    $nomeuc_en = $_POST["nomeuc_en"];
    $nomeuc_es = $_POST["nomeuc_es"];
    $nomeuc_be = $_POST["nomeuc_be"];
    $nomeuc_is = $_POST["nomeuc_is"];
    $uniuc = $_POST["uniuc"];
    $uniuc_en = $_POST["uniuc_en"];
    $uniuc_es = $_POST["uniuc_es"];
    $uniuc_be = $_POST["uniuc_be"];
    $uniuc_is = $_POST["uniuc_is"];

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssssssssi', $nomeuc, $nomeuc_en, $nomeuc_es, $nomeuc_be, $nomeuc_is, $uniuc, $uniuc_en, $uniuc_es, $uniuc_be, $uniuc_is, $idDone_CU);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../courses_t.php");
            $_SESSION["uc"] = 2;
        } else {
            header("Location: ../courses_t.php");
            $_SESSION["uc"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../courses_t.php");
        $_SESSION["uc"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../courses_t.php");
    $_SESSION["uc"] = 2;
}

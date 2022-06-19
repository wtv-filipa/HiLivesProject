<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idDone_CU = $_GET["uc"];
$id_navegar = $_SESSION["idUser"];

$query = "UPDATE done_cu
SET cu_name_be = ?, university_name_be = ?, date_cu = ?
WHERE iddone_cu = ?";

if (!empty($_POST["nomeuc"]) && !empty($_POST["uniuc"]) && !empty($_POST["data"]) && isset($_GET["uc"])) {
  
    $idDone_CU = $_GET["uc"];
    $nomeuc = $_POST["nomeuc"];
    $uniuc = $_POST["uniuc"];
    $data = $_POST["data"];

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssi', $nomeuc, $uniuc, $data, $idDone_CU);
        if (!mysqli_stmt_execute($stmt)) {           
           header("Location: ../be/pages/editCourse.php?uc=$idDone_CU");
            $_SESSION["doneCU"] = 1;
        } else {
            header("Location: ../be/pages/profile.php?user=$id_navegar");
            $_SESSION["profile"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
       header("Location: ../be/pages/editCourse.php?uc=$idDone_CU");
        $_SESSION["doneCU"] = 1;
    }
    mysqli_close($link);
} else {
    header("Location: ../be/pages/editCourse.php?uc=$idDone_CU");
    $_SESSION["doneCU"] = 2;
}
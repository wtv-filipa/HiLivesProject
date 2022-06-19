<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "UPDATE users
SET status_create = ?
WHERE idusers = ?";

$query2 = "UPDATE users
SET status_edit = ?
WHERE idusers = ?";

if (isset($_GET["create"])) {
    $idUserCreate = $_GET["create"];
    $status_create = 2;

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $status_create, $idUserCreate);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../is/pages/IndividualReqCreateTutor.php?create=$idUserCreate");
            $_SESSION["create"] = 2;
        } else {
            header("Location: ../is/pages/IndividualReqCreateTutor.php?create=$idUserCreate");
            $_SESSION["create"] = 3;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../is/pages/IndividualReqCreateTutor.php?create=$idUserCreate");
        $_SESSION["create"] = 2;
    }
    mysqli_close($link);
} else if (isset($_GET["edit"])) {
    $idUserEdit = $_GET["edit"];
    $status_edit = 2;

    if (mysqli_stmt_prepare($stmt, $query2)) {
        mysqli_stmt_bind_param($stmt, 'ii', $status_edit, $idUserEdit);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../is/pages/IndividualReqEditTutor.php?edit=$idUserEdit");
            $_SESSION["edit"] = 2;
        } else {
            header("Location: ../is/pages/IndividualReqEditTutor.php?edit=$idUserEdit");
            $_SESSION["edit"] = 3;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../is/pages/IndividualReqEditTutor.php?edit=$idUserEdit");
        $_SESSION["edit"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../is/pages/homeTutor.php");
}

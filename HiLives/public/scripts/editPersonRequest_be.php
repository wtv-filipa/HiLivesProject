<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "UPDATE users
SET edit_request = ?, status_edit = ?
WHERE idusers = ?";

if (isset($_GET["req"])) {
    $idUserRequest = $_GET["req"];
    $edit_request = 1;
    $status_edit = 1;

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'iii', $edit_request, $status_edit, $idUserRequest);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../be/pages/editProfile.php?edit=$idUserRequest");
            $_SESSION["edit_jovem"] = 3;
        } else {
            header("Location: ../be/pages/editProfile.php?edit=$idUserRequest");
            $_SESSION["edit_jovem"] = 4;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../be/pages/editProfile.php?edit=$idUserRequest");
        $_SESSION["edit_jovem"] = 3;
    }
    mysqli_close($link);
} else {
    header("Location: ../be/pages/editProfile.php?edit=$idUserRequest");
    $_SESSION["edit_jovem"] = 3;
}

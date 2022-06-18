<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "UPDATE contact
SET solved = ?
WHERE idcontact = ?";

if (isset($_GET["contact"])) {
    $idcontact = $_GET["contact"];
    $solved = 1;

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $solved, $idcontact);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../contact.php");
            $_SESSION["contact"] = 2;
        } else {
            header("Location: ../contact.php");
            $_SESSION["contact"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../contact.php");
        $_SESSION["contact"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../contact.php");
    $_SESSION["contact"] = 2;
}
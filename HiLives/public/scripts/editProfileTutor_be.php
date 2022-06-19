<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$id_navegar = $_SESSION["idUser"];

$query = "UPDATE users
SET name_user = ?, email_user = ?, contact_user = ?
WHERE idusers = ?";

if (isset($_GET["edit"]) && !empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["phone"])) {

    $idUser = $_GET["edit"];
    $name_user = $_POST["nome"];
    $email_user = $_POST["email"];
    $contact_user = $_POST["phone"];

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssi', $name_user, $email_user, $contact_user, $idUser);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../be/pages/profile.php?user=$id_navegar");
            $_SESSION["edit_tutor"] = 3;
        } else {
            header("Location: ../be/pages/profile.php?user=$id_navegar");
            $_SESSION["edit_tutor"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../be/pages/profile.php?user=$id_navegar");
        $_SESSION["edit_tutor"] = 3;
    }
    mysqli_close($link);
} else {
    header("Location: ../be/pages/profile.php?user=$id_navegar");
    $_SESSION["edit_tutor"] = 2;
}

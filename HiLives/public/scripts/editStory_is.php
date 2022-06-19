<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_GET["xp"]) && isset($_SESSION["idUser"]) && !empty($_POST["descricao"])) {
    $id_xp = $_GET["xp"];
    $id_navegar = $_SESSION["idUser"];
    $description = $_POST['descricao'];

    $query = "UPDATE experiences
      SET description_is = ?
      WHERE idexperiences = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'si', $description, $id_xp);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../is/pages/editStory.php?edit=$id_xp");
            $_SESSION["story"] = 1;
        } else {
            header("Location: ../is/pages/profile.php?user=$id_navegar");
            $_SESSION["profile"] = 4;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../is/pages/editStory.php?edit=$id_xp");
        $_SESSION["story"] = 1;
    }
    mysqli_close($link);
} else {
    header("Location: ../is/pages/editStory.php?edit=$id_xp");
    $_SESSION["story"] = 2;
}

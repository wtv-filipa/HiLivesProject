<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$id_navegar = $_SESSION["idUser"];

$query = "DELETE FROM done_cu 
WHERE iddone_cu = ?";

if (isset($_GET["apaga"])) {
    $idCourse = $_GET["apaga"];
    // echo "estou aqui para apagar uma vaga de emprego";
    // echo "</br> é o curso $idCourse";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idCourse);

        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../en/pages/profile.php?user=$id_navegar");
            $_SESSION["profile"] = 5;
        } else {
            mysqli_stmt_close($stmt);

            header("Location: ../en/pages/profile.php?user=$id_navegar");
            $_SESSION["profile"] = 6;
        }
    } else {

        header("Location: ../en/pages/profile.php?user=$id_navegar");
        $_SESSION["profile"] = 5;
    }
    mysqli_close($link);
} else {
    header("Location: ../en/pages/profile.php?user=$id_navegar");
    $_SESSION["profile"] = 5;
}
